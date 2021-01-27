<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 20:32
 */

namespace mmerlijn\msg\src\Hl7\traits;

use mmerlijn\msg\src\Hl7\segments\OBX;
use mmerlijn\msg\src\repo\Order;
use mmerlijn\msg\src\repo\OrderComment;
use mmerlijn\msg\src\repo\OrderNote;
use mmerlijn\msg\src\repo\Orders;


trait GetOrdersTrait
{
    public function getOrders()
    {
        $Orders = new Orders();
        $nrsORC = $this->getSegmentNrs('ORC');
        $nrsOBR = $this->getSegmentNrs('OBR');
        if (!is_array($nrsOBR)) {
            $nrsOBR = [];
        }
        if(isset($nrsORC[0])) {
            $nr = $nrsORC[0];

            $value = $this->getValue($nr, 1); //NW=new order, CA=cancel request, RO=replacement order, XO=change order request
            $Orders->control = $value ? $value : "NW";
            $Orders->phone = $this->getValue($nr, 23, 1);

            $Orders->order_status = $this->getValue($nr, 5);
            //Requestnr
            $value = $this->getValue($nr, 4, 1);
            if (!$value) {
                $value = $this->getValue($nr, 2, 1);
            }
            if ($value) {
                $Orders->requestnr = $value;
            }

            $value = $this->getValue($nr, 3, 1);;
            $Orders->labnr = $value ? $value : '';

            $requestDate = $this->getValue($nr, 7, 4, 1);
            $Orders->request_date = $this->setDatetimeFormat($requestDate, 'ORC', "7.4.1");

            $Orders->priority = $this->getValue($nr, 7, 6);


            $created_at = $this->getValue($nr, 9, 1);
            $Orders->created_at = $this->setDatetimeFormat($created_at, 'ORC', 9);
            $Orders->entered_by = [
                'agbcode' => $this->getValue($nr, 10, 1),
                'name' => trim($this->getValue($nr, 10, 2, 1) . ", " . $this->getValue($nr, 10, 3), ", "),
                'source' => $this->getValue($nr, 10, 9, 1),
            ];
            $Orders->verified_by = [
                'agbcode' => $this->getValue($nr, 11, 1),
                'name' => trim($this->getValue($nr, 11, 2, 1) . ", " . $this->getValue($nr, 11, 3), ", "),
                'source' => $this->getValue($nr, 11, 9, 1),
            ];
            $Orders->requester = [
                'agbcode' => $this->getValue($nr, 12, 1),
                'name' => trim($this->getValue($nr, 12, 2, 1) . ", " . $this->getValue($nr, 12, 3), ", "),
                'source' => $this->getValue($nr, 12, 9, 1),
                'street'=>'',
                'buildingnr'=>'',
                'city'=>'',
            ];
            $Orders->entering_location = [
                'agbcode' => $this->getValue($nr, 13, 4, 2),
                'name' => $this->getValue($nr, 13, 4, 1),
                'location' => $this->getValue($nr, 13, 9)
            ];
            $value = $this->getValue($nr, 13, 1);
            $Orders->pointOfCare = $value ? $value : '';
            if (isset($this->tree[$nr][14])) {
                foreach ($this->tree[$nr][14] as $order) {
                    if (($order[3] ?? null) == 'PH') {

                        $Orders->phone = $order[1];
                    }
                    if (($order[3] ?? null) == 'FX') {
                        $Orders->fax = $order[1];
                    }
                }
            }
            $updateTime = $this->getValue($nr, 15, 1);   //by codes  “CA”, “RO” or “XO”
            $Orders->update_time_request = $this->setDatetimeFormat($updateTime, 'ORC', 15);
            //orc17
            $Orders->entering_organisation = [
                'agbcode' => $this->getValue($nr, 17, 1),
                'name' => $this->getValue($nr, 17, 2),
                'source' => $this->getValue($nr, 17, 3),
            ];
            $Orders->action_by = [
                'agbcode' => $this->getValue($nr, 19, 1),
                'name' => $this->getValue($nr, 19, 2, 1) . ", " . $this->getValue($nr, 19, 3),
                'source' => $this->getValue($nr, 19, 9, 1),
            ];
            //orc21
            $Orders->ordering_facility = [
                'agbcode' => $this->getValue($nr, 21, 3),
                'name' => $this->getValue($nr, 21, 1),
                'source' => $this->getValue($nr, 21, 6, 1),
            ];
            if ($Orders->control != "NW") {
                $effDatetime = $this->getValue($nr, 15, 1);

                $Orders->order_effective_datetime = $this->setDatetimeFormat($effDatetime, 'ORC', 15);
            }
        }
        $nrPV1 = $this->getSegmentNrs('PV1', true);
        if ($nrPV1 !== false) {
            $Orders->patient_visit_set_id = $this->getValue($nrPV1, 1);
            $Orders->patient_visit_class = $this->getValue($nrPV1, 2);
            $Orders->patient_visit_assigned_location['point_of_care'] = $this->getValue($nrPV1, 3, 1);
            $Orders->patient_visit_visit_number['id_number'] = $this->getValue($nrPV1, 19, 1);
            $Orders->patient_visit_indicator = $this->getValue($nrPV1, 51);
            $Orders->pv1 = true;
        }
        $nrPV2 = $this->getSegmentNrs('PV2', true);
        if ($nrPV2 !== false) {
            $Orders->admit_reason_code = $this->getValue($nrPV2, 3, 1);
            $Orders->admit_reason_name = $this->getValue($nrPV2, 3, 2);
            $Orders->admit_reason_source = $this->getValue($nrPV2, 3, 3);
        }
        foreach ($nrsOBR as $nr) {
            $Order = new Order();
            /*TODO check for multiple diagnostic tests as a repeat OBR.4*/

            $Order->id = $this->getValue($nr, 1);
            $Order->placer_order_nr = $this->getValue($nr, 2, 1); //bv zdnr
            $Order->filler_order_nr = $this->getValue($nr, 3, 1); //labnr

            $Order->diagnostic_test_code = $this->getValue($nr, 4, 1); //testcode
            $Order->diagnostic_test_name = $this->getValue($nr, 4, 2);
            $Order->diagnostic_test_source = $this->getValue($nr, 4, 3); //99zda=Zorgdomein defined, 99zdl=user defined, else see Table0396
            $Order->alternate_diagnostic_test_code = $this->getValue($nr, 4,4); //alternate testcode
            $Order->alternate_diagnostic_test_name = $this->getValue($nr, 4,5);
            $Order->alternate_diagnostic_test_source = $this->getValue($nr, 4,6);

            if (!$Orders->priority) {
                $Orders->priority = $this->getValue($nr, 5);
            }
            $startTime = $this->getValue($nr, 7, 1);
            $Order->observation_start_time = $this->setDatetimeFormat($startTime, 'OBR', 7);

            $endTime = $this->getValue($nr, 8, 1);
            $Order->observation_end_time = $this->setDatetimeFormat($endTime, 'OBR', 8);

            $Order->action_code = $this->getValue($nr, 11); //at home => L, else O
            if (!$Orders->phone) {
                $Orders->phone = $this->getValue($nr, 17, 1); //phone callback
            }
            $Order->collection_volume_quantity = $this->getValue($nr, 9,1);
            $Order->collection_volume_units = $this->getValue($nr, 9,2);

            $Orders->result_status = $this->getValue($nr, 25);//F=final, C=correction
            $Orders->diagnostic_serv = $this->getValue($nr, 24);//bv LAB
            $Orders->resultDateTime = $this->setDatetimeFormat($this->getValue($nr, 22, 1), $nr, 22);
            $Orders->timing_quantity['priority'] = $this->getValue($nr, 27, 6);

            if (!in_array($Orders->action_code, ['L', "O"])) {
                $Orders->action_code = $Order->action_code;
            }
            $Order->specimen_received_datetime = $this->setDatetimeFormat($this->getValue($nr, 14, 1), $nr, 14);
            $Order->specimen_source = $this->getValue($nr, 15, 1, 1);

            $Order->clinical_information = $this->getValue($nr, 13);

            //$requestDate = $this->getValue($nr, 27, 4, 1);
            //$Order->request_date = $this->setDatetimeFormat($requestDate, 'OBR', 27);
            if (!$Orders->request_date) {
                $requestDate = $this->getValue($nr, 20);
                $Orders->request_date = $this->setDatetimeFormat($requestDate, 'OBR', 20);
            }
            $Orders->collectors_comment = $this->getValue($nr, 39, 2);

            $Orders->copy_to = [
                'agbcode' =>  $this->getValue($nr, 28, 1),
                'name' => $this->getValue($nr, 28, 2, 1),
                'source' => $this->getValue($nr, 28, 9, 1),
                'street'=>'',
                'buildingnr'=>'',
                'city'=>'',
            ];
            $Orders->collector_identifier = [
                'id' => $this->getValue($nr, 10, 1),
                'last_name' => $this->getValue($nr, 10, 2, 1),
                'first_name' => $this->getValue($nr, 10, 3)
            ];
            $i = $nr;
            //OrderNotices of the OBR
            while ($this->ifNextSegmentIs($i, 'NTE')) {
                $i++;
                $OrderNotice = new OrderNote();
                $OrderNotice->id = $this->getValue($i, 1);
                $OrderNotice->source_of_comment = $this->getValue($i, 2);
                $OrderNotice->comment = $this->getValue($i, 3);
                $Order->addOrderNote($OrderNotice);
            }
            while ($this->ifNextSegmentIs($i, 'OBX')) {
                $i++;

                $OrderComment = new OrderComment();
                $value = [];
                if (count($this->tree[$i][5]) > 1) {
                    $OrderComment->repeated = true;
                }
                // TODO repeatable
                switch ($this->getValue($i, 2)) {
                    case "CE":
                        if ($OrderComment->repeated) {
                            foreach ($this->tree[$i][5] as $item) {
                                $value['value_code'][] = $item[1];
                                $value['value'][] = $item[2];
                                $value['value_source'][] = $item[3];
                            }
                        } else {
                            $value = [
                                'value_code' => $this->getValue($i, 5, 1),
                                'value' => $this->getValue($i, 5, 2),
                                'value_source' => $this->getValue($i, 5, 3),
                            ];
                        }
                        break;
                    case "ST":
                    case "CF":
                    case "DT":
                    case "FT":
                    case "NM":
                    case "TX":
                    case "TM":
                        if ($OrderComment->repeated) {
                            foreach ($this->tree[$i][5] as $item) {
                                $value['value_code'][] = '';
                                $value['value'][] = $item;
                                $value['value_source'][] = '';
                            }
                        }
                        $value = ['value' => $this->getValue($i, 5), 'value_code' => '', 'value_source' => ''];
                        break;
                    case "ED":
                        throw new \Exception('OBX  ' . $i . ' containts ED not implemented jet (getOrdersTrait)');
                        break;
                }
                $OrderComment->id = $this->getValue($i, 1);
                $OrderComment->type_of_value = $this->getValue($i, 2);
                $OrderComment->identifier_code = $this->getValue($i, 3, 1);
                $OrderComment->identifier_label = $this->getValue($i, 3, 2);
                $OrderComment->identifier_source = $this->getValue($i, 3, 3);//99zda=Zorgdomein defined, 99zdl=user defined, else see Table0396

                $OrderComment->identifier_alternate_code = $this->getValue($i, 3, 4);
                $OrderComment->identifier_alternate_label = $this->getValue($i, 3, 5);
                $OrderComment->identifier_alternate_source = $this->getValue($i, 3, 6);

                $OrderComment->value = $value['value'];
                $OrderComment->value_code = $value['value_code'];
                $OrderComment->value_source = $value['value_source'];
                $OrderComment->units = $this->getValue($i, 6, 1);
                $OrderComment->references_range = $this->getValue($i, 7);
                $OrderComment->result_status = $this->getValue($i, 11);
                $OrderComment->abnormal_flags = $this->getValue($i, 8);
                $OrderComment->datetime_of_the_observation = $this->setDatetimeFormat($this->getValue($i, 14, 1), $nr, 14);
                $OrderComment->equipment_instance_identifier = $this->getValue($i, 18, 1);
                $OrderComment->datetime_of_analysis = $this->setDatetimeFormat($this->getValue($i, 19, 1), $nr, 19);

                //OrderNotices of the OBX
                while ($this->ifNextSegmentIs($i, 'NTE')) {
                    $i++;
                    $OrderNotice = new OrderNote();
                    $OrderNotice->id = $this->getValue($i, 1);
                    $OrderNotice->source_of_comment = $this->getValue($i, 2);
                    $OrderNotice->comment = $this->getValue($i, 3);
                    $OrderComment->addOrderNote($OrderNotice);
                }
                $Order->addOrderComment($OrderComment);

            }
            $Order->position = count($Orders->orders);
            $Orders->addOrder($Order);
        }

        return $Orders;

//https://zorgdomein.com/integrator/documentation/classic-edition/hl7-v2-specifications/orm-lfdv2/

    }


}