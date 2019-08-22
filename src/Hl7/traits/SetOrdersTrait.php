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
        //pv2
        if ($Orders->admit_reason_name) {
            $this->setOrderAdmitReason($Orders->admit_reason_code, $Orders->admit_reason_name, $Orders->admit_reason_source);
        }
        if($Orders->pv1) {
            $this->setOrderPatientVisit();
        }
        $orcIsSet = false;
        foreach ($Orders->orders as $teller => $order) {
            if ($repeatOrc or !$orcIsSet) {
                $this->createSegment('ORC', count(static::$tree));
                $orcIsSet = true;
            }
            $nr = $this->createSegment('OBR', count(static::$tree));
            $this->setOrder($order, $nr, $teller + 1);
        }

        $this->setOrderControl($Orders->control);
        $this->setOrderUpdateTimeRequest($Orders->update_time_request);
        $this->setOrderPhone($Orders->phone);
        $this->setOrderFax($Orders->fax);

        $this->setOrderRequestnr($Orders->requestnr);
        $this->setOrderLabnr($Orders->labnr);
        $this->setOrderRequestDate($Orders->request_date);
        $this->setPointOfCare($Orders->pointOfCare);
        $this->setOrderCreatedAt($Orders->created_at);
        $this->setOrderEnteredBy($Orders->entered_by['name']??null, $Orders->entered_by['agbcode']??null, $Orders->entered_by['source']??null);
        $this->setOrderVerifiedBy($Orders->verified_by['name']??null, $Orders->verified_by['agbcode']??null, $Orders->verified_by['source']??null);
        $this->setOrderOrganisation($Orders->entering_organisation['name'], $Orders->entering_organisation['agbcode'], $Orders->entering_organisation['source']);
        $this->setOrderLocation($Orders->entering_location['location'], $Orders->entering_location['name'], $Orders->entering_location['agbcode']);
        $this->setOrderActionBy($Orders->action_by['name'], $Orders->action_by['agbcode'], $Orders->action_by['source']);
        $this->setOrderFacility($Orders->ordering_facility['name'], $Orders->ordering_facility['agbcode'], $Orders->ordering_facility['source']);
        $this->setOrderEffectiveDatetime($Orders->order_effective_datetime);

        //put to ORC and OBR
        $this->setOrderCopyTo($Orders->copy_to['name'], $Orders->copy_to['agbcode'], $Orders->copy_to['source']);
        $this->setOrderCollectorIdentifier($Orders->collector_identifier['id'], $Orders->collector_identifier['last_name'], $Orders->collector_identifier['first_name']);
        $this->setOrderPriority($Orders->priority);
        $this->setOrderActionCode($Orders->action_code);
        $this->setOrderRequester($Orders->requester['name'], $Orders->requester['agbcode'], $Orders->requester['source']);
        $this->setOrderResponsibleObserver($Orders);

        $this->setObservingOrganisation($Orders);
        $this->setCollectorsComment($Orders->collectors_comment);

    }
    private function deleteCurrentOrders()
    {
        $nr = $this->getSegmentNrs('PV1', true);
        if($nr!==false) {
            unset(static::$tree[$nr]);
        }
        $nr = $this->getSegmentNrs('PV2',true);
        if($nr!==false) {
            unset(static::$tree[$nr]);
        }
        $nrs = $this->getSegmentNrs('OBX',false);
        if($nrs!==false) {
            foreach (array_reverse($nrs) as $nr) {
                unset(static::$tree[$nr]);
            }
        }
        $nrs = $this->getSegmentNrs('OBR',false);
        if($nrs!==false) {
            foreach (array_reverse($nrs) as $nr) {
                unset(static::$tree[$nr]);
            }
        }
        $nrs = $this->getSegmentNrs('ORC',false);
        if($nrs!==false) {
            foreach (array_reverse($nrs) as $nr) {
                unset(static::$tree[$nr]);
            }
        }
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
                foreach (static::$tree[$nr][14] as $i => $order) {

                    if (!($order[1] ?? null)) {
                        $empty = false;
                    }
                    if (($order[3] ?? null) == $type) {
                        //already exist
                        static::$tree[$nr][14][$i][1] = $value;
                        $found = true;
                    }
                }
                if (!$found) {
                    if ($empty) {
                        $new_nr = $this->addRepeatField($nr, 14);
                    } else {
                        $new_nr = 0;
                    }
                    static::$tree[$nr][14][$new_nr][1] = $value;
                    static::$tree[$nr][14][$new_nr][2] = 'WPN';
                    static::$tree[$nr][14][$new_nr][3] = $type;
                }

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
                if($name) {
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
                if($name) {
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
                if($name) {
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
                if($name) {
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
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 17, 1);
                    }
                }
                if($name) {
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
                if($name) {
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
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 21, 9, 1);
                    }
                }
                if($name) {
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
                    $this->setValue($agbcode, $nr, 12, 1);
                    if (is_numeric($agbcode)) {
                        $this->setValue($source ? $source : 'VEKTIS', $nr, 12, 9, 1);
                    }
                }
                if($name) {
                    $this->setValue($name, $nr, 12, 2, 1);
                    $this->setValue($initials, $nr, 12, 3);
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

    private function setOrderPatientVisit($set_id = 1, $class = "O", $indicator = "V"): void
    {
        $nr = $this->getSegmentNrs('PV1', true, true);
        if ($nr !== false) {
            $this->setValue($set_id, $nr, 1);
            $this->setValue($class, $nr, 2);
            $this->setValue($indicator, $nr, 51);
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
        $this->setValue($Order->observation_start_time ? date_create_from_format("Y-m-d H:i:s", $Order->observation_start_time)->format($this->dateTimeFormatOut) : '', $new_nr, 7, 1);
        $this->setValue($Order->observation_end_time ? date_create_from_format("Y-m-d H:i:s", $Order->observation_end_time)->format($this->dateTimeFormatOut) : '', $new_nr, 8, 1);
        $this->setValue($Order->action_code, $new_nr, 11);
        $this->setValue($Order->clinical_information, $new_nr, 13);
        $this->setValue($Order->request_date ? date_create_from_format("Y-m-d H:i:s", $Order->request_date)->format($this->dateTimeFormatOut) : '', $new_nr, 27, 4, 1);
        $orcnr = $this->getSegmentNrs('ORC', true);
        static::$tree[$new_nr][16] = static::$tree[$orcnr][12]; //requester
        static::$tree[$new_nr][17] = static::$tree[$orcnr][14]; //phone and fax
        //Order comments
        $extraSegments = 0;
        foreach ($Order->order_comments as $i => $order_comment) {
            $nr = $this->createSegment('OBX', $new_nr + $i + 1 + $extraSegments);
            $order_comment->id = $i + 1;
            $this->setOrderComments($order_comment, $nr);
            $extraSegments += count($order_comment->notes);
        }
    }

    private function setOrderComments(OrderComment $OrderComment, $nr)
    {
        if(!$OrderComment->type_of_value){
            if($OrderComment->value_code){
                $OrderComment->type_of_value="CE";
            }else{
                $OrderComment->type_of_value="ST";
            }
        }
        static::$tree[$nr][5][0] = Table0125::getClass($OrderComment->type_of_value)::setEmpty();
        $this->setValue($OrderComment->id, $nr, 1);
        $this->setValue($OrderComment->type_of_value, $nr, 2);

        $this->setValue($OrderComment->identifier_code, $nr, 3, 1);
        $this->setValue($OrderComment->identifier_label, $nr, 3, 2);
        $this->setValue($OrderComment->identifier_source, $nr, 3, 3);
        if($OrderComment->identifier_alternate_code){
            $this->setValue($OrderComment->identifier_alternate_code, $nr, 3, 4);
        }
        if($OrderComment->identifier_alternate_label){
            $this->setValue($OrderComment->identifier_alternate_label, $nr, 3, 5);
        }
        if($OrderComment->identifier_alternate_source){
            $this->setValue($OrderComment->identifier_alternate_source, $nr, 3, 6);
        }

        if ($OrderComment->repeated) {
            foreach ($OrderComment->value as $t => $v) {
                if (!isset(static::$tree[$nr[5][$t]])) {
                    $f = $this->addRepeatField($nr, 5);
                } else {
                    $f = $t;
                }
                static::$tree[$nr][5][$f][1] = $OrderComment->value_code[$t];
                static::$tree[$nr][5][$f][2] = $OrderComment->value[$t];
                static::$tree[$nr][5][$f][3] = $OrderComment->value_source[$t];
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
        foreach ($OrderComment->notes as $i => $note) {
            $this->createSegment('NTE', $nr + 1);
            $this->setvalue($i + 1, $nr + 1, 1);
            $this->setvalue("O", $nr + 1, 2);
            $this->setValue($note, $nr + 1, 3);
            $this->setValue("Opm. uitslag", $nr + 1, 4, 2);
        }
    }
}