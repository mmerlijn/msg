<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 6-2-2019
 * Time: 13:45
 */

namespace mmerlijn\msg\src\Hl7;

use mmerlijn\msg\src\Hl7\segments\IN1;
use mmerlijn\msg\src\Hl7\segments\LBS;
use mmerlijn\msg\src\Hl7\segments\MSH;
use mmerlijn\msg\src\Hl7\segments\NTE;
use mmerlijn\msg\src\Hl7\segments\OBR;
use mmerlijn\msg\src\Hl7\segments\OBX;
use mmerlijn\msg\src\Hl7\segments\ORC;
use mmerlijn\msg\src\Hl7\segments\PID;
use mmerlijn\msg\src\Hl7\segments\PV1;
use mmerlijn\msg\src\Hl7\segments\PV2;
use mmerlijn\msg\src\Hl7\traits\GetOrdersTrait;
use mmerlijn\msg\src\Hl7\traits\GetPatientTrait;
use mmerlijn\msg\src\Hl7\traits\GetHeaderTrait;
use mmerlijn\msg\src\Hl7\traits\SetHeaderTrait;
use mmerlijn\msg\src\Hl7\traits\SetOrdersTrait;
use mmerlijn\msg\src\Hl7\traits\SetPatientTrait;

class HL7ZorgdomeinAanvraag extends HL7
{
    use GetHeaderTrait, GetPatientTrait, GetOrdersTrait, SetHeaderTrait, SetOrdersTrait, SetPatientTrait;

    protected $allowedSegments = [
        'MSH' => MSH::class,
        'PID' => PID::class,
        'PV1' => PV1::class,
        'PV2' => PV2::class,
        'IN1' => IN1::class,
        'ORC' => ORC::class,
        'OBR' => OBR::class,
        'OBX' => OBX::class,
        'NTE' => NTE::class,
        'LBS' => LBS::class
    ];

//https://zorgdomein.com/integrator/documentation/classic-edition/hl7-v2-specifications/orm-lfdv2/


}