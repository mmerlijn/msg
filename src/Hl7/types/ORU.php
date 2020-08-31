<?php


namespace mmerlijn\msg\src\Hl7\types;


use mmerlijn\msg\src\Hl7\segments\DSC;
use mmerlijn\msg\src\Hl7\segments\MSH;
use mmerlijn\msg\src\Hl7\segments\NTE;
use mmerlijn\msg\src\Hl7\segments\OBR;
use mmerlijn\msg\src\Hl7\segments\OBX;
use mmerlijn\msg\src\Hl7\segments\ORC;
use mmerlijn\msg\src\Hl7\segments\PID;
use mmerlijn\msg\src\Hl7\segments\PV1;
use mmerlijn\msg\src\Hl7\segments\PV2;

//ORU_R01
class ORU extends Message
{
    public $allowedSegments=[
        'MSH'=>MSH::class,
        'PID'=>PID::class,
        'NTE'=>NTE::class,
        //'NK1'=>NK1::class,
        'PV1'=>PV1::class,
        'PV2'=>PV2::class,
        'ORC'=>ORC::class,
        'OBR'=>OBR::class,
        //'TQ1'=>TQ1::class,
        //'TQ2'=>TQ2::class,
        //'CTD'=>CTD::class,
        'OBX'=>OBX::class,
        //'FT1'=>FT1::class,
        //'CTI'=>CTI::class,
        //'SPM'=>SPM::class,
        'DSC'=>DSC::class
    ];
    public $structure=[
        'MSH'=>MSH::class,
        'PID'=>PID::class,
        'NTE'=>NTE::class,
        //'NK1'=>NK1::class,
        'PV1'=>PV1::class,
        'PV2'=>PV2::class,
        'ORC'=>ORC::class,
        'OBR'=>OBR::class,
        'NTE2'=>NTE::class,
        //'TQ1'=>TQ1::class,
        //'TQ2'=>TQ2::class,
        //'CTD'=>CTD::class,
        'OBX'=>OBX::class,
        'NTE3'=>NTE::class,
        //'FT1'=>FT1::class,
        //'CTI'=>CTI::class,
        //'SPM'=>SPM::class,
        //'OBX2'=>OBX::class,
        //'DSC'=>DSC::class
    ];
}