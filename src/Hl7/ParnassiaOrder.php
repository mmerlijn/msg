<?php


namespace mmerlijn\msg\src\Hl7;



use mmerlijn\msg\src\Hl7\segments\MSH;

use mmerlijn\msg\src\Hl7\segments\OBR;
use mmerlijn\msg\src\Hl7\segments\OBX;
use mmerlijn\msg\src\Hl7\segments\ORC;
use mmerlijn\msg\src\Hl7\segments\PID;

use mmerlijn\msg\src\Hl7\traits\GetHeaderTrait;
use mmerlijn\msg\src\Hl7\traits\GetOrdersTrait;
use mmerlijn\msg\src\Hl7\traits\GetPatientTrait;
use mmerlijn\msg\src\Hl7\traits\SetHeaderTrait;
use mmerlijn\msg\src\Hl7\traits\SetOrdersTrait;
use mmerlijn\msg\src\Hl7\traits\SetPatientTrait;

class ParnassiaOrder extends HL7
{
    use GetHeaderTrait, GetPatientTrait, GetOrdersTrait, SetHeaderTrait, SetOrdersTrait, SetPatientTrait;

    protected static $allowedSegments = [
        'MSH' => MSH::class,
        'PID' => PID::class,
        'ORC' => ORC::class,
        'OBR' => OBR::class,
        'OBX' => OBX::class,
    ];
}