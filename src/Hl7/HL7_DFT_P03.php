<?php

namespace mmerlijn\msg\src\Hl7;

use mmerlijn\msg\src\Hl7\segments\EVN;
use mmerlijn\msg\src\Hl7\segments\FT1;
use mmerlijn\msg\src\Hl7\segments\IN1;
use mmerlijn\msg\src\Hl7\segments\MSH;
use mmerlijn\msg\src\Hl7\segments\OBR;
use mmerlijn\msg\src\Hl7\segments\ORC;
use mmerlijn\msg\src\Hl7\segments\PD1;
use mmerlijn\msg\src\Hl7\segments\PID;
use mmerlijn\msg\src\Hl7\segments\PV1;
use mmerlijn\msg\src\Hl7\segments\PV2;
use mmerlijn\msg\src\Hl7\traits\GetFinancialTrait;
use mmerlijn\msg\src\Hl7\traits\GetPatientTrait;
use mmerlijn\msg\src\Hl7\traits\GetHeaderTrait;
use mmerlijn\msg\src\Hl7\traits\SetHeaderTrait;
use mmerlijn\msg\src\Hl7\traits\SetPatientTrait;

class HL7_DFT_P03 extends HL7
{
    use GetHeaderTrait, GetPatientTrait, SetHeaderTrait, SetPatientTrait, GetFinancialTrait;

    protected $allowedSegments = [
        'MSH' => MSH::class,
        'EVN' => EVN::class,
        'PID' => PID::class,
        'PD1' => PD1::class,
        'PV1' => PV1::class,
        'PV2' => PV2::class,
        'ORC' => ORC::class,
        'OBR' => OBR::class,
        'FT1' => FT1::class,
        'IN1' => IN1::class,
    ];
}