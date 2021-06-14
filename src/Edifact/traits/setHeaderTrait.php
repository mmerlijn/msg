<?php


namespace mmerlijn\msg\src\Edifact\traits;


use mmerlijn\msg\src\repo\Header;

trait setHeaderTrait
{
    public function setHeader(Header $h)
    {
        $nr = $this->getSegmentNrs('UNB',true,true);
        $this->setValue('UNOA', $nr, 1,1);
        $this->setValue('1', $nr, 1,2);
        $this->setValue($h->sending_facility, $nr, 2,1);
        $this->setValue($h->receiving_facility, $nr, 3,1);
        $this->setValue(date_create($h->datetime_of_message)->format('ymd'), $nr,4, 1);
        $this->setValue(date_create($h->datetime_of_message)->format('Hi'), $nr,4, 2);
        $this->setValue( "SNM".$h->message_control_id, $nr, 5,1);

        $nr = $this->getSegmentNrs('UNH',true,true);
        $this->setValue($h->message_control_id, $nr, 1,1);
        $this->setValue($h->message_type_type, $nr, 2, 1);
        $this->setValue(1, $nr, 2, 2);

        $nr = $this->getSegmentNrs('GGA',true,true);
        $this->setValue($h->sender['name'], $nr, 1,1);
        $this->setValue($h->sender['department'], $nr, 2,1);
        $this->setValue($h->sender['name'], $nr, 3,1);
        $this->setValue($h->sender['street'], $nr, 4,1);
        $this->setValue($h->sender['buildingnr'], $nr, 4,2);
        $this->setValue($h->sender['city'], $nr, 4,4);
        $this->setValue($h->sender['postcode'], $nr, 4,5);
        $this->setValue($h->sender['phone'], $nr, 5,1);

        if(!$this->segmentExists('DET')) {
            $nr = $this->getSegmentNrs('DET', true, true);
            $now = date_create();
            $this->setValue($now->format('y'), $nr, 1, 1);
            $this->setValue($now->format('m'), $nr, 1, 2);
            $this->setValue($now->format('d'), $nr, 1, 3);
            $this->setValue($now->format('H'), $nr, 2, 1);
            $this->setValue($now->format('i'), $nr, 2, 2);
        }

        if($h->message_type_type=="MEDVRI"){
            $nr = $this->getSegmentNrs('GGO',true,true);
            $this->setValue($h->receiver['name'], $nr, 1,1);
            $this->setValue($h->receiver['street'], $nr, 4,1);
            $this->setValue($h->receiver['buildingnr'], $nr, 4,2);
            $this->setValue($h->receiver['city'], $nr, 4,4);
            $this->setValue($h->receiver['postcode'], $nr, 4,5);
            $this->setValue($h->receiver['phone'], $nr, 5,1);
        }

        $nr = $this->getSegmentNrs('UNT',true,true);
        $this->setValue($h->message_control_id, $nr, 2, 1);
        $nr = $this->getSegmentNrs('UNZ',true,true);
        $this->setValue(1, $nr, 1, 1);
        $this->setValue("SNM".$h->message_control_id, $nr, 2, 1);
    }
}