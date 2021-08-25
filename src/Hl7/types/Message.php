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

class Message
{
    //default all supported segments
    protected $segments=[
        'MSH'=>MSH::class,
        'NTE'=>NTE::class,
        'PID'=>PID::class,
        'PD1'=>PD1::class,
        'PV1'=>PV1::class,
        'IN1'=>IN1::class,
        'IN2'=>IN2::class,
        'IN3'=>IN3::class,
        'ORC'=>ORC::class,
        'OBR'=>OBR::class,
        'OBX'=>OBX::class,
    ];
    protected $application=[];

    public function getSegments(string $application=''):array
    {
        if(isset($this->application[$application])){
            return $this->application[$application];
        }
        return $this->segments;
    }
}