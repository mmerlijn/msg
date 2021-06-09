<?php


namespace mmerlijn\msg\src\Edifact;


use mmerlijn\msg\src\Edifact\segments\DET;
use mmerlijn\msg\src\Edifact\segments\GGA;
use mmerlijn\msg\src\Edifact\segments\GGO;
use mmerlijn\msg\src\Edifact\segments\PAD;
use mmerlijn\msg\src\Edifact\segments\PID;
use mmerlijn\msg\src\Edifact\segments\TXT;
use mmerlijn\msg\src\Edifact\segments\UNA;
use mmerlijn\msg\src\Edifact\segments\UNB;
use mmerlijn\msg\src\Edifact\segments\UNH;
use mmerlijn\msg\src\Edifact\segments\UNT;
use mmerlijn\msg\src\Edifact\segments\UNZ;

class MEDVRI extends Edifact
{

    protected $messageType="MEDVRI";
    public $structure = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'GGA' => GGA::class,
        'DET' => DET::class,
        'PID' => PID::class,
        'PAD' => PAD::class,
        'TXT' => TXT::class,
        'GGO' => GGO::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,

    ];
    //MUST be set by child
    public $allowedSegments = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'DET' => DET::class,
        'GGA' => GGA::class,
        'GGO' => GGO::class,
        'PID' => PID::class,
        'PAD' => PAD::class,
        'TXT' => TXT::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,
    ];
}