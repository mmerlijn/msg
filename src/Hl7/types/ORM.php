<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 10:21
 */

namespace mmerlijn\msg\src\Hl7\types;

use mmerlijn\msg\src\Hl7\segments\IN1;
use mmerlijn\msg\src\Hl7\segments\IN2;
use mmerlijn\msg\src\Hl7\segments\IN3;
use mmerlijn\msg\src\Hl7\segments\OBR;
use mmerlijn\msg\src\Hl7\segments\OBX;
use mmerlijn\msg\src\Hl7\segments\ORC;
use mmerlijn\msg\src\Hl7\segments\PID;
use mmerlijn\msg\src\Hl7\segments\MSH;
use mmerlijn\msg\src\Hl7\segments\NTE;
use mmerlijn\msg\src\Hl7\segments\PD1;
use mmerlijn\msg\src\Hl7\segments\PV1;
use mmerlijn\msg\src\Hl7\segments\PV2;

class ORM extends Message
{
    //default
    private static $segments=[
      'MSH'=>MSH::class,
      'NTE'=>NTE::class,
      'PID'=>PID::class,
        'PV1'=>PV1::class,
        'PV2'=>PV2::class,
        'IN1'=>IN1::class,
        'IN2'=>IN2::class,
        'IN3'=>IN2::class,
        'GT1'=>GT1::class,
        'AL1'=>AL1::class,
        'ORC'=>ORC::class,
        'OBR'=>OBR::class,
        'OBX'=>OBX::class,
        'DG1'=>DG1::class,
        'CTI'=>CTI::class,
        'BLG'=>BLG::class,
    ];
    //Zorgdomein
    protected $application=['ZorgDomein'=>[
        'MSH'=>MSH::class,
        'PID'=>PID::class,
        'PV1'=>PV1::class,
        'IN1'=>IN1::class,
        'ORC'=>ORC::class,
        'OBR'=>OBR::class,
        'OBX'=>OBX::class
    ]
    ];
    private static $emptyStructure = [
        1 => ['class' => MSH::class, 'opt' => 'R', 'rpt' => false, 'name' => 'Message header segment'],
        2 => ['class' => PID::class, 'opt' => 'R', 'rpt' => false, 'name' => 'Patient Identification'],
        3 => ['class' => PV1::class, 'opt' => 'R', 'rpt' => false, 'name' => ''],
        4 => ['class' => IN1::class, 'opt' => 'R', 'rpt' => false, 'name' => ''],
        5 => ['class' => ORC::class, 'opt' => 'R', 'rpt' => false, 'name' => ''],
        6 => ['class' => OBR::class, 'opt' => 'R', 'rpt' => false, 'name' => ''],
    ];

}