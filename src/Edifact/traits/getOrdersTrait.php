<?php


namespace mmerlijn\msg\src\Edifact\traits;


use mmerlijn\msg\src\repo\Order;
use mmerlijn\msg\src\repo\OrderComment;
use mmerlijn\msg\src\repo\Orders;

trait getOrdersTrait
{
    public function getOrders()
    {
        $Order = new Orders();
        $Order->control="RE";
        $SegNr = $this->getSegmentNrs('ART',true);
        if($SegNr) {
            $Order->requester['agbcode'] = $this->getValue($SegNr, 2);
            $Order->requester['name'] = trim(trim($this->getValue($SegNr, 3, 2) . " " . $this->getValue($SegNr, 3, 1)) . ", " . $this->getValue($SegNr, 3, 3), ", ");
            $Order->requester['source'] = "VEKTIS";
        }
        $SegNr = $this->getSegmentNrs('AFD',true);
        if($SegNr) {
            $Order->collector_identifier['name'] = $this->getValue($SegNr, 1);
            $Order->entering_location['name'] = $Order->requester['name'];
            $Order->entering_location['location'] = $this->getValue($SegNr, 4, 1) . " " . $this->getValue($SegNr, 4, 2) . " " . $this->getValue($SegNr, 4, 4);
        }

        //Even kijken of dit er wel in moet
        //$SegNr = $this->getSegmentNrs('ARA',true);
        //if($SegNr) {
        //    $Order->responsible_observer_name = $this->getValue($SegNr, 1);
        //}

        $SegNr = $this->getSegmentNrs('IDE',true);
        if($SegNr){
            $Order->labnr = $this->getValue($SegNr, 2);
            $Order->complete = $this->getValue($SegNr, 1);
        }

        //even kijken of dit er wel in moet
        //$SegNr = $this->getSegmentNrs('ZKH',true);
        //if($SegNr){
        //    $Order->organisation_name = $this->getValue($SegNr, 1);
        //    $Order->organisation_address['street'] = $this->getValue($SegNr, 2, 1);
        //    $Order->organisation_address['buildingnr'] = $this->getValue($SegNr, 2, 2);
        //    $Order->organisation_address['city'] = $this->getValue($SegNr, 2, 4);
        //    $Order->organisation_address['postcode'] = $this->getValue($SegNr, 2, 5);
        //    $Order->organisation_phone = $this->getValue($SegNr, 3);
        //}
        $o = new Order();
        //$o->placer_order_nr = //zdnr
        //$o->filler_order_nr = //labnr
        $SegNr = $this->getSegmentNrs('DET',true);
        $o->observation_start_time = date_create_from_format("ymdhi"
            , $this->getValue($SegNr, 1, 1)
            .$this->getValue($SegNr, 1, 2)
            .$this->getValue($SegNr, 1, 3)
            .$this->getValue($SegNr, 2, 1)
            .$this->getValue($SegNr, 2, 2))->format("Y-m-d H:i:s");
        $Order->addOrder($o);
        $segNrs = $this->getSegmentNrs('BEP');
        foreach ($segNrs as $SegNr)
        {
            if($this->getValue($SegNr, 1)==0) {
                $c = new OrderComment();
                $c->type_of_value = "ST";
                $c->identifier_code = $this->getValue($SegNr, 9);
                $c->identifier_label = $this->getValue($SegNr, 2);
                $c->identifier_source = "L";
                $c->value = $this->getValue($SegNr, 3);
                $c->units = $this->getValue($SegNr, 5);
                $c->references_range = trim($this->getValue($SegNr, 7) . "-" . $this->getValue($SegNr, 8),"-");
                if($c->value) {
                    $c->result_status = "C";
                }
                if($this->ifNextSegmentIs($SegNr, 'OPB')){
                    $c->notes[] = $this->getOPB($SegNr);
                }
                $Order->addComment($c);
            }
        }
        $segNrs = $this->getSegmentNrs('NUB');
        if($segNrs) {
            foreach ($segNrs as $SegNr) {
                $c = new OrderComment();
                $c->type_of_value = "ST";
                $c->identifier_label = $this->getValue($SegNr, 1);
                $c->identifier_code = "";
                $c->identifier_source = "L";
                $c->result_status = "I";
                $Order->addComment($c);
            }
        }
        return $Order;
    }

    private function getOPB($segmentnr)
    {
        $opm=[];
        while($this->ifNextSegmentIs($segmentnr, 'OPB'))
        {
            $segmentnr++;
            $opm[] = trim($this->getValue($segmentnr, 1));
        }
        return implode(" ", $opm);
    }
}