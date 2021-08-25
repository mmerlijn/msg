<?php


namespace mmerlijn\msg\src\Edifact\traits;


use mmerlijn\msg\src\repo\Patient;

trait setPatientTrait
{
    public function setPatient(Patient $p)
    {
        $nr = $this->getSegmentNrs('PID',true,true);
        $dob = date_create($p->dob);
        $this->setValue($dob->format('Y'), $nr, 1,1);
        $this->setValue($dob->format('m'), $nr, 1,2);
        $this->setValue($dob->format('d'), $nr, 1,3);

        $this->setValue((strtoupper($p->sex)=='F')?'V':'M', $nr, 2,1);
        $this->setValue($p->last_name, $nr, 3,1);
        $this->setValue($p->last_name_prefix, $nr, 3,2);
        $this->setValue($p->surname, $nr, 3,3);
        $this->setValue($p->surname_prefix, $nr, 3,4);
        $this->setValue(str_replace([" ","."], "", $p->initials), $nr, 3,6);
        $this->setValue("BSN".$p->bsn, $nr, 5,1);

        $nr = $this->getSegmentNrs('PAD',true,true);
        $this->setValue($p->street, $nr, 1,1);
        $this->setValue($p->building_nr_full?:$p->building_nr, $nr, 1,2);
        $this->setValue($p->city, $nr, 1,4);
        $this->setValue($p->postcode, $nr, 1,5);
        $this->setValue($p->phones[0]??'', $nr, 2,1);
    }
}