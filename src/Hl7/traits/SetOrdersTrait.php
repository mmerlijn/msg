<?php


namespace mmerlijn\msg\src\Hl7\traits;


use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\CF;
use mmerlijn\msg\src\Hl7\fields\DT;
use mmerlijn\msg\src\Hl7\fields\ED;
use mmerlijn\msg\src\Hl7\fields\FT;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TM;
use mmerlijn\msg\src\Hl7\fields\TX;
use mmerlijn\msg\src\Hl7\tables\Table0125;
use mmerlijn\msg\src\repo\Order;
use mmerlijn\msg\src\repo\OrderComment;
use mmerlijn\msg\src\repo\Orders;

trait SetOrdersTrait
{

    public function setOrders(Orders $Orders, $repeatOrc = true)
    {
        $this->deleteCurrentOrders();
        //only set when $Orders->pv1 = true
        $this->setOrderPatientVisit($Orders);
        //pv2
        if ($Orders->admit_reason_name) {
            $this->setOrderAdmitReason($Orders->admit_reason_code, $Orders->admit_reason_name, $Orders->admit_reason_source);
        }


        $orcIsSet = false;
        $teller=1;
        foreach ($Orders->orders as $k=>$o){
            if ($repeatOrc or !$orcIsSet) {
                $this->createSegment('ORC', count($this->tree));
                $orcIsSet = true;
            }
            $nr = $this->createSegment('OBR', count($this->tree));
            $this->setOrder($o, $nr, $teller++);
        }
        $this->setOrderControl($Orders->control);
        $this->setOrderControlReason($Orders->order_control_reason);
        $this->setOrderUpdateTimeRequest($Orders->update_time_request);

        $this->setOrderFax($Orders->fax);

        $this->setOrderRequestnr($Orders->requestnr);
        $this->setOrderLabnr($Orders->labnr);
        $this->setOrderRequestDate($Orders->request_date);
        $this->setPointOfCare($Orders->pointOfCare);
        $this->setOrderCreatedAt($Orders->created_at);
        $this->setOrderEnteredBy($Orders->entered_by['name'] ?? '', $Orders->entered_by['agbcode'] ?? '', $Orders->entered_by['source'] ?? '');
        $this->setOrderVerifiedBy($Orders->verified_by['name'] ?? '', $Orders->verified_by['agbcode'] ?? '', $Orders->verified_by['source'] ?? '');
        $this->setOrderOrganisation($Orders->entering_organisation['name'] ?? '', $Orders->entering_organisation['agbcode'] ?? '', $Orders->entering_organisation['source'] ?? '');
        $this->setOrderLocation($Orders->entering_location['location']??'', $Orders->entering_location['name']??'', $Orders->entering_location['agbcode']??'');
        $this->setOrderActionBy($Orders->action_by['name'] ?? '', $Orders->action_by['agbcode'] ?? '', $Orders->action_by['source']??'');
        $this->setOrderFacility($Orders->ordering_facility['name'] ?? '', $Orders->ordering_facility['agbcode']??'', $Orders->ordering_facility['source']??'');
        $this->setOrderEffectiveDatetime($Orders->order_effective_datetime);
        $this->setOrderStatus($Orders->order_status??'');

        //put to ORC and OBR
        $this->setOrderPhone($Orders->phone);
        $this->setOrderCopyTo($Orders->copy_to['name'], $Orders->copy_to['agbcode'], $Orders->copy_to['source']);
        $this->setOrderCollectorIdentifier($Orders->collector_identifier['id'], $Orders->collector_identifier['last_name'], $Orders->collector_identifier['first_name']);
        $this->setOrderPriority($Orders->priority);
        $this->setOrderActionCode($Orders->action_code);
        $this->setOrderDiagnosticServ($Orders->diagnostic_serv);
        $this->setOrderResultStatus($Orders->result_status);
        $this->setOrderResultDateTime($Orders->resultDateTime);
        $this->setOrderTimingQuantity($Orders->timing_quantity);
        $this->setOrderRequester($Orders->requester['name'], $Orders->requester['agbcode'], $Orders->requester['source']);
        $this->setOrderResponsibleObserver($Orders);

        $this->setObservingOrganisation($Orders);
        $this->setCollectorsComment($Orders->collectors_comment);
    }

    private function deleteCurrentOrders()
    {
        $nr = $this->getSegmentNrs('PV1', true);
        if ($nr !== false) {
            unset($this->tree[$nr]);
        }
        $nr = $this->getSegmentNrs('PV2', true);
        if ($nr !== false) {
            unset($this->tree[$nr]);
        }
        $nrs = $this->getSegmentNrs('OBX', false);
        if ($nrs !== false) {
            foreach (array_reverse($nrs) as $nr) {
                unset($this->tree[$nr]);
            }
        }
        $nrs = $this->getSegmentNrs('OBR', false);
        if ($nrs !== false) {
            foreach (array_reverse($nrs) as $nr) {
                unset($this->tree[$nr]);
            }
        }
        $nrs = $this->getSegmentNrs('ORC', false);
        if ($nrs !== false) {
            foreach (array_reverse($nrs) as $nr) {
                unset($this->tree[$nr]);
            }
        }
        $nrs = $this->getSegmentNrs('NTE', false);
        if ($nrs !== false) {
            foreach (array_reverse($nrs) as $nr) {
                unset($this->tree[$nr]);
            }
        }
        $this->tree = array_values($this->tree); ///array keys reset
    }

    private function setOrderResponsibleObserver($Orders)
    {
        if ($Orders->responsible_observer_name) {
            $nrs = $this->getSegmentNrs('OBX');
            foreach ($nrs as $nr) {
                $this->setvalue($Orders->responsible_observer_name, $nr, 16, 1);
            }
        }
    }

    private function setObservingOrganisation(Orders $Orders)
    {
        $nrs = $this->getSegmentNrs('OBX');
        if ($Orders->organisation_name) {
            foreach ($nrs as $nr) {
                $this->setValue($Orders->organisation_name, $nr, 23, 1);
            }
        }
        if ($Orders->organisation_address['city']) {
            foreach ($nrs as $nr) {
                $this->setValue(trim($Orders->organisation_address['street'] . " " . $Orders->organisation_address['buildingnr']), $nr, 24, 1, 1);
                $this->setValue($Orders->organisation_address['city'], $nr, 24, 3);
                $this->setValue($Orders->organisation_address['postcode'], $nr, 24, 5);
                $this->setValue('NLD', $nr, 24, 6);

            }
        }
    }

    private function setCollectorsComment($comment)
    {
        if ($comment) {
            $nrs = $this->getSegmentNrs('OBR');
            foreach ($nrs as $nr) {
                $this->setValue($comment, $nr, 39, 2);
            }
        }
    }

    private function setOrderAdmitReason(string $code, string $name, string $source): void
    {
        $nr = $this->getSegmentNrs('PV2', true, true);
        if ($nr !== false) {
            $this->setValue($code, $nr, 3, 1);
            $this->setValue($name, $nr, 3, 2);
            $this->setValue($source, $nr, 3, 3);
        }
    }

    private function setOrderUpdateTimeRequest(string $value): void
    {
        $updateTime = $value ? date_create_from_format("Y-m-d H:i:s", $value)->format($this->dateTimeFormatOut) : '';
        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (is_array($nrs)) {
            foreach ($nrs as $nr) {
                $this->setValue($updateTime, $nr, 15, 1);
            }
        } else {
            $this->setValue($updateTime, $nrs, 15, 1);
        }
    }


    private function setOrderCallback(string $value, string $type): void
    {
        if ($value) {
            $nrs = $this->getSegmentNrs('ORC', false, true);

            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }

            foreach ($nrs as $nr) {
                $found = false;
                $empty = true;
                foreach ($this->tree[$nr][14] as $i => $order) {

                    if (!($order[1] ?? null)) {
                        $empty = false;
                    }
                    if (($order[3] ?? null) == $type) {
                        //already exist
                        $this->tree[$nr][14][$i][1] = $value;
                        $found = true;
                    }
                }
                if (!$found) {
                    if ($empty) {
                        $new_nr = $this->addRepeatField($nr, 14);
                    } else {
                        $new_nr = 0;
                    }
                    $this->tree[$nr][14][$new_nr][1] = $value;
                    $this->tree[$nr][14][$new_nr][2] = 'WPN';
                    $this->tree[$nr][14][$new_nr][3] = $type;
                }

            }
            $nrs = $this->getSegmentNrs('OBR', false, true);

            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                $this->setValue($value, $nr, 17, 1);
            }
        }

    }

    private function setOrderPhone(string $value): void
    {
        $this->setOrderCallback($value, 'PH');
    }

    private function setOrderFax(string $value): void
    {
        $this->setOrderCallback($value, 'FX');
    }

    private function setOrderControl(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 1);
        }
    }
    private function setOrderControlReason(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 16,1);
        }
    }
    private function setOrderRequestnr(string $value): void
    {

        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 2, 1);
            $this->setValue($value, $nr, 4, 1);
        }
        $nrs = $this->getSegmentNrs('OBR', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 2, 1);
        }
    }

    private function setOrderLabnr(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 3, 1);
        }
        $nrs = $this->getSegmentNrs('OBR', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 3, 1);
        }
    }

    private function setOrderRequestDate(string $value): void
    {
        if ($value) {
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                $this->setValue($value ? date_create_from_format("Y-m-d H:i:s", $value)->format($this->dateTimeFormatOut) : '', $nr, 7, 4, 1);
            }
            $nrs = $this->getSegmentNrs('OBR', false, false);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                $this->setValue($value ? date_create_from_format("Y-m-d H:i:s", $value)->format($this->dateTimeFormatOut) : '', $nr, 20);
            }
        }
    }

    private function setOrderPriority(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 7, 6);
        }
        $nrs = $this->getSegmentNrs('OBR', false);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 5);
        }
    }

    private function setOrderActionCode(string $value): void
    {
        $nrs = $this->getSegmentNrs('OBR', false);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 11);
        }
    }

    private function setOrderDiagnosticServ(string $value): void
    {
        $nrs = $this->getSegmentNrs('OBR', false);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 24);
        }
    }

    private function setOrderResultStatus(string $value): void
    {
        $nrs = $this->getSegmentNrs('OBR', false);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 25);
        }
    }

    private function setOrderResultDateTime(string $value): void
    {
        if ($value) {
            $nrs = $this->getSegmentNrs('OBR', false);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                $this->setValue($value ? date_create_from_format("Y-m-d H:i:s", $value)->format($this->dateTimeFormatOut) : "", $nr, 22, 1);
            }
        }
    }

    private function setOrderTimingQuantity(array $value): void
    {
        $nrs = $this->getSegmentNrs('OBR', false);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value['priority'], $nr, 27, 6);
        }
    }

    private function setOrderCreatedAt(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value ? date_create_from_format("Y-m-d H:i:s", $value)->format($this->dateTimeFormatOut) : "", $nr, 9, 1);
        }
    }

    private function setOrderEnteredBy(string $name, string $agbcode = null, string $source = 'VEKTIS'): void
    {

        if ($name or $agbcode) {
            $namePiece = explode(",", $name);
            $name = trim($namePiece[0]);
            $initials = trim($namePiece[1] ?? "");
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 10, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 10, 9, 1);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 10, 2, 1);
                    $this->setValue($initials, $nr, 10, 3);
                }
            }
        }
    }

    private function setOrderVerifiedBy(string $name, string $agbcode = null, string $source = 'VEKTIS'): void
    {
        if ($name or $agbcode) {
            $namePiece = explode(",", $name);
            $name = trim($namePiece[0]);
            $initials = trim($namePiece[1] ?? "");
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 11, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 11, 9, 1);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 11, 2, 1);
                    $this->setValue($initials, $nr, 11, 3);
                }
            }
        }
    }

    private function setOrderLocation(string $location, string $name, string $agbcode = null): void
    {
        if ($location) {
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                $this->setValue($agbcode, $nr, 13, 4, 2);
                $this->setValue($location, $nr, 13, 9);
                $this->setValue($name, $nr, 13, 4, 1);
            }
        }
    }

    private function setPointOfCare(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 13, 1);
        }
    }

    private function setOrderRequester(string $name, string $agbcode = null, string $source = 'VEKTIS'): void
    {
        if ($name or $agbcode) {
            $namePiece = explode(",", $name);
            $name = trim($namePiece[0]);
            $initials = trim($namePiece[1] ?? "");
            //Add to ORC
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 12, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 12, 9, 1);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 12, 2, 1);
                    $this->setValue($initials, $nr, 12, 3);
                }
            }
            //Add to OBR
            $nrs = $this->getSegmentNrs('OBR', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 16, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 16, 9, 1);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 16, 2, 1);
                    $this->setValue($initials, $nr, 16, 3);
                }
            }
        }
    }

    private function setOrderOrganisation(string $name, string $agbcode = null, string $source = 'VEKTIS'): void
    {

        if ($name or $agbcode) {
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 17, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 17, 3);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 17, 2);
                }
            }
        }
    }

    private function setOrderActionBy(string $name, string $agbcode = null, string $source = 'VEKTIS'): void
    {
        if ($name or $agbcode) {
            $namePiece = explode(",", $name);
            $name = trim($namePiece[0]);
            $initials = trim($namePiece[1] ?? "");
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 19, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 19, 9, 1);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 19, 2, 1);
                    $this->setValue($initials, $nr, 19, 3);
                }
            }
        }
    }

    private function setOrderFacility(string $name, string $agbcode = null, string $source = 'VEKTIS'): void
    {
        if ($name or $agbcode) {
            $nrs = $this->getSegmentNrs('ORC', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 21, 3);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 21, 6, 1);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 21, 1);
                }
            }
        }
    }

    private function setOrderCopyTo(string $name, string $agbcode = null, string $source = 'VEKTIS'): void
    {
        if ($name or $agbcode) {
            $namePiece = explode(",", $name);
            $name = trim($namePiece[0]);
            $initials = trim($namePiece[1] ?? "");
            $nrs = $this->getSegmentNrs('OBR', false, true);
            if (!is_array($nrs)) {
                $nrs = [$nrs];
            }
            foreach ($nrs as $nr) {
                if ($agbcode) {
                    $this->setValue($agbcode, $nr, 28, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 28, 9, 1);
                    }
                }
                if ($name) {
                    $this->setValue($name, $nr, 28, 2, 1);
                    $this->setValue($initials, $nr, 28, 3);
                }
            }
        }
    }

    private function setOrderCollectorIdentifier($id, $last_name, $first_name): void
    {
        $nrs = $this->getSegmentNrs('OBR', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($id, $nr, 10, 1);
            $this->setValue($last_name, $nr, 10, 2, 1);
            $this->setValue($first_name, $nr, 10, 3);

        }
    }

    private function setOrderEffectiveDatetime(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            if (in_array($this->getValue($nr, 1), ['CA', 'RO', 'XO'])) {
                $this->setValue($value ? date_create_from_format($this->dateTimeFormatOut, $value)->format("Y-m-d H:i:s") : '', $nr, 15);
            }
        }
    }

    private function setOrderStatus(string $value): void
    {
        $nrs = $this->getSegmentNrs('ORC', false, true);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, 5);
        }
    }

    //params [$k=>$v] with $k=order param en $k=value
    private function setOrderPatientVisit(Orders $O): void
    {
        if ($O->pv1) {
            $nr = $this->getSegmentNrs('PV1', true, true);
            if ($nr !== false) {
                $this->setValue($O->patient_visit_set_id, $nr, 1);
                $this->setValue($O->patient_visit_class, $nr, 2);
                $this->setValue($O->patient_visit_assigned_location['point_of_care'] ?? '', $nr, 3, 1);
                $this->setValue($O->patient_visit_visit_number['id_number'] ?? '', $nr, 19, 1);
                $this->setValue($O->patient_visit_indicator, $nr, 51);
            }
        }

    }

    private function setOrder(Order $Order, $new_nr, $OBRnr = 1)
    {
        $this->setValue($OBRnr, $new_nr, 1);
        $this->setValue($Order->placer_order_nr, $new_nr, 2, 1);
        $this->setValue($Order->filler_order_nr, $new_nr, 3, 1);
        $this->setValue($Order->diagnostic_test_code, $new_nr, 4, 1);
        $this->setValue($Order->diagnostic_test_name, $new_nr, 4, 2);
        $this->setValue($Order->diagnostic_test_source, $new_nr, 4, 3);
        $this->setValue($Order->alternate_diagnostic_test_code, $new_nr, 4, 4);
        $this->setValue($Order->alternate_diagnostic_test_name, $new_nr, 4, 5);
        $this->setValue($Order->alternate_diagnostic_test_source, $new_nr, 4, 6);

        $this->setValue($Order->observation_start_time ? date_create_from_format("Y-m-d H:i:s", $Order->observation_start_time)->format($this->dateTimeFormatOut) : '', $new_nr, 7, 1);
        $this->setValue($Order->observation_end_time ? date_create_from_format("Y-m-d H:i:s", $Order->observation_end_time)->format($this->dateTimeFormatOut) : '', $new_nr, 8, 1);
        $this->setValue($Order->action_code, $new_nr, 11);
        $this->setValue($Order->clinical_information, $new_nr, 13);
        $this->setValue($Order->request_date ? date_create_from_format("Y-m-d H:i:s", $Order->request_date)->format($this->dateTimeFormatOut) : '', $new_nr, 27, 4, 1);

        $this->setValue($Order->collection_volume_quantity,$new_nr,9,1);
        $this->setValue($Order->collection_volume_units,$new_nr,9,2);

        $this->setValue($Order->specimen_received_datetime ? date_create_from_format("Y-m-d H:i:s", $Order->specimen_received_datetime)->format($this->dateTimeFormatOut) : '', $new_nr, 14, 1);
        $this->setValue($Order->specimen_source, $new_nr, 15, 1, 1);
        $orcnr = $this->getSegmentNrs('ORC', true);
        $this->tree[$new_nr][16] = $this->tree[$orcnr][12]; //requester
        $this->tree[$new_nr][17] = $this->tree[$orcnr][14]; //phone and fax
        //Order notes
        foreach ($Order->notes as $i => $note) {
            $nr = $this->createSegment('NTE', $new_nr + 1 + $i);
            $this->setvalue($i + 1, $nr, 1);
            $this->setvalue($note->source_of_comment ?? 'O', $nr, 2);
            $this->setValue($note->comment, $nr, 3);
        }
        //Order comments
        $extraSegments = count($Order->notes);
        foreach ($Order->order_comments as $i => $order_comment) {
            $nr = $this->createSegment('OBX', $new_nr + $i + 1 + $extraSegments);
            $order_comment->id = $i + 1;
            $this->setOrderComments($order_comment, $nr);
            $extraSegments += count($order_comment->notes);
        }
    }

    private function setOrderComments(OrderComment $OrderComment, $nr)
    {
        if (!$OrderComment->type_of_value) {
            if ($OrderComment->value_code) {
                $OrderComment->type_of_value = "CE";
            } else {
                $OrderComment->type_of_value = "ST";
            }
        }
        $this->tree[$nr][5][0] = Table0125::getClass($OrderComment->type_of_value)::setEmpty();
        $this->setValue($OrderComment->id, $nr, 1);
        $this->setValue($OrderComment->type_of_value, $nr, 2);

        $this->setValue($OrderComment->identifier_code, $nr, 3, 1);
        $this->setValue($OrderComment->identifier_label, $nr, 3, 2);
        $this->setValue($OrderComment->identifier_source, $nr, 3, 3);
        if ($OrderComment->identifier_alternate_code) {
            $this->setValue($OrderComment->identifier_alternate_code, $nr, 3, 4);
        }
        if ($OrderComment->identifier_alternate_label) {
            $this->setValue($OrderComment->identifier_alternate_label, $nr, 3, 5);
        }
        if ($OrderComment->identifier_alternate_source) {
            $this->setValue($OrderComment->identifier_alternate_source, $nr, 3, 6);
        }

        if ($OrderComment->repeated) {
            foreach ($OrderComment->value as $t => $v) {
                if (!isset($this->tree[$nr][5][$t])) {
                    $f = $this->addRepeatField($nr, 5);
                } else {
                    $f = $t;
                }
                $this->tree[$nr][5][$f][1] = $OrderComment->value_code[$t];
                $this->tree[$nr][5][$f][2] = $OrderComment->value[$t];
                $this->tree[$nr][5][$f][3] = $OrderComment->value_source[$t];
            }
        } else {
            if ($OrderComment->type_of_value == 'CE') {
                $this->setValue($OrderComment->value, $nr, 5, 2);
                $this->setValue($OrderComment->value_code, $nr, 5, 1);
                $this->setValue($OrderComment->value_source, $nr, 5, 3);
            } else {
                $this->setValue($OrderComment->value, $nr, 5);
            }

        }

        if ($OrderComment->units) {
            $this->setValue($OrderComment->units, $nr, 6, 1);
        }
        $this->setValue($OrderComment->references_range, $nr, 7);
        $this->setValue($OrderComment->result_status, $nr, 11);
        $this->setValue($OrderComment->abnormal_flags, $nr, 8);
        $this->setValue($OrderComment->equipment_instance_identifier, $nr, 18, 1);
        $this->setValue($OrderComment->datetime_of_the_observation ? date_create_from_format("Y-m-d H:i:s", $OrderComment->datetime_of_the_observation)->format($this->dateTimeFormatOut) : '', $nr, 14, 1);
        $this->setValue($OrderComment->datetime_of_analysis ? date_create_from_format("Y-m-d H:i:s", $OrderComment->datetime_of_analysis)->format($this->dateTimeFormatOut) : '', $nr, 19, 1);


        foreach ($OrderComment->notes as $i => $note) {
            $nr = $this->createSegment('NTE', $nr + 1 + $i);
            $this->setvalue($i + 1, $nr, 1);
            $this->setvalue($note->source_of_comment ?? 'O', $nr, 2);
            $this->setValue($note->comment, $nr, 3);
            //$this->setValue("Opm. uitslag", $nr + 1, 4, 2);
        }
    }
}