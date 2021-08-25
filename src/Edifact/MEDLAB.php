<?php


namespace mmerlijn\msg\src\Edifact;


use mmerlijn\msg\src\Edifact\segments\AFD;
use mmerlijn\msg\src\Edifact\segments\ARA;
use mmerlijn\msg\src\Edifact\segments\ART;
use mmerlijn\msg\src\Edifact\segments\BEP;
use mmerlijn\msg\src\Edifact\segments\BLG;
use mmerlijn\msg\src\Edifact\segments\COM;
use mmerlijn\msg\src\Edifact\segments\DET;

use mmerlijn\msg\src\Edifact\segments\IDE;
use mmerlijn\msg\src\Edifact\segments\KOP;
use mmerlijn\msg\src\Edifact\segments\NUB;
use mmerlijn\msg\src\Edifact\segments\OPB;
use mmerlijn\msg\src\Edifact\segments\OPM;
use mmerlijn\msg\src\Edifact\segments\OPU;
use mmerlijn\msg\src\Edifact\segments\PAD;
use mmerlijn\msg\src\Edifact\segments\PID;
use mmerlijn\msg\src\Edifact\segments\SEC;
use mmerlijn\msg\src\Edifact\segments\UNA;
use mmerlijn\msg\src\Edifact\segments\UNB;
use mmerlijn\msg\src\Edifact\segments\UNH;
use mmerlijn\msg\src\Edifact\segments\UNT;
use mmerlijn\msg\src\Edifact\segments\UNZ;
use mmerlijn\msg\src\Edifact\segments\ZKH;

class MEDLAB extends Edifact
{
    protected $messageType="MEDLAB";
    public $structure = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'ZKH' =>ZKH::class,
        'PID' => PID::class,
        'PAD' => PAD::class,
        'BLG' =>BLG::class,
        'ART'=>ART::class,
        'AFD'=>AFD::class,
        'ARA'=>ARA::class,
        'KOP'=>KOP::class,
        'DET'=>DET::class,
        'IDE'=>IDE::class,
        'OPM'=>OPM::class,
        'SEC'=>SEC::class,
        'BEP'=>BEP::class,
        'OPB'=>OPB::class,
        'NUB'=>NUB::class,
        'OPU'=>OPU::class,
        'COM' =>COM::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,


    ];
    //MUST be set by child
    public $allowedSegments = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'AFD' => AFD::class,
        'ARA'=>ARA::class,
        'ART'=>ART::class,
        'BEP'=>BEP::class,
        'BLG' =>BLG::class,
        'COM' =>COM::class,
        'DET'=>DET::class,
        'IDE'=>IDE::class,
        'KOP'=>KOP::class,
        'NUB'=>NUB::class,
        'OPB'=>OPB::class,
        'OPM'=>OPM::class,
        'OPU'=>OPU::class,
        'PID' => PID::class,
        'PAD' => PAD::class,
        'SEC'=>SEC::class,
        'ZKH' =>ZKH::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,
    ];
}