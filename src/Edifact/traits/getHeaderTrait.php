<?php


namespace mmerlijn\msg\src\Edifact\traits;


use mmerlijn\msg\src\repo\Header;

trait getHeaderTrait
{
    public function getHeader()
    {
        $h = new Header();
        $nr = $this->getSegmentNrs('UNB',true);
        $h->sending_facility = $this->getValue($nr, 2,1);
        $h->receiving_facility = $this->getValue($nr, 3,1);
        $datetime = date_create_from_format('ymdHi', $this->getValue($nr, 4,1).$this->getValue($nr, 4,2));
        $h->datetime_of_message = $datetime->format('Y-m-d H:i:s');
        $h->message_control_id = $this->getValue($nr, 5);
        //$h->message_type_structure = $this->getValue($nr, 1,1);
        
        $nr = $this->getSegmentNrs('UNH',true);
        $h->message_type_type = $this->getValue($nr, 2,1);

        $nr = $this->getSegmentNrs('GGA',true);
        $h->sender['name'] = $this->getValue($nr, 1);
        $h->sender['department'] = $this->getValue($nr, 2);
        $h->sender['street'] = $this->getValue($nr, 4,1);
        $h->sender['buildingnr'] = $this->getValue($nr, 4,2);
        $h->sender['city'] = $this->getValue($nr, 4,4);
        $h->sender['postcode'] = $this->getValue($nr, 4,5);
        $h->sender['phone'] = $this->getValue($nr, 5);

        $h->country_code="NLD";
        return $h;
    }
}