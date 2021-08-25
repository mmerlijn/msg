<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Bsn;
use mmerlijn\msg\src\Edifact\fields\Geboortedatum;
use mmerlijn\msg\src\Edifact\fields\Geslacht;
use mmerlijn\msg\src\Edifact\fields\Patientnaam;
use mmerlijn\msg\src\Edifact\fields\PatientReferentieNr;

class PID extends Segment
{
    protected static $name = 'PID';
    protected static $structure = [
        1 => ['class' => Geboortedatum::class,  'opt' => 'M', 'name' => 'Geboortedatum'],
        2 => ['class' => Geslacht::class,  'opt' => 'M', 'name' => 'Geslacht'],
        3 => ['class' => Patientnaam::class,  'opt' => 'M', 'name' => 'Patientnaam'],
        4 => ['class' => PatientReferentieNr::class, 'opt' => 'C', 'name' => 'Patientreferentienr verzender'],
        5 => ['class' => Bsn::class, 'opt' => 'C', 'name' => 'BSN'],
    ];
}