<?php
//version synthax rules

namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0020;
use mmerlijn\msg\src\Edifact\fields\F0026;
use mmerlijn\msg\src\Edifact\fields\F0029;
use mmerlijn\msg\src\Edifact\fields\F0031;
use mmerlijn\msg\src\Edifact\fields\F0032;
use mmerlijn\msg\src\Edifact\fields\F0035;
use mmerlijn\msg\src\Edifact\fields\S001;
use mmerlijn\msg\src\Edifact\fields\S002;
use mmerlijn\msg\src\Edifact\fields\S003;
use mmerlijn\msg\src\Edifact\fields\S004;
use mmerlijn\msg\src\Edifact\fields\S005;


//MANDATORY M
//OPTIONAL  O Indicates that the entity is optional and may be sent at the discretion of the user

//type F=fixed O=variable (length specification
class UNB extends Segment
{
    protected static $name = 'UNB';
    protected static $structure = [
        1 => ['class' => S001::class,  'opt' => 'M', 'name' => 'Syntax identifier'],
        2 => ['class' => S002::class,  'opt' => 'M', 'name' => 'INTERCHANGE SENDER'],
        3 => ['class' => S003::class,  'opt' => 'M', 'name' => 'INTERCHANGE RECIPIENT'],
        4 => ['class' => S004::class,  'opt' => 'M', 'name' => 'DATE/TIME OF PREPARATION'],
        5 => ['class' => F0020::class,  'opt' => 'M', 'name' => 'INTERCHANGE CONTROL REFERENCE'],
        6 => ['class' => S005::class,  'opt' => 'C', 'name' => 'RECIPIENTS REFERENCE / PASSWORD'],
        7 => ['class' => F0026::class,  'opt' => 'C', 'name' => 'APPLICATION REFERENCE'],
        8 => ['class' => F0029::class,  'opt' => 'C', 'name' => 'PROCESSING PRIORITY CODE'],
        9 => ['class' => F0031::class,  'opt' => 'C', 'name' => 'ACKNOWLEDGEMENT REQUEST'],
        10 => ['class' => F0032::class,  'opt' => 'C', 'name' => 'COMMUNICATIONS AGREEMENT ID'],
        11 => ['class' => F0035::class,  'opt' => 'C', 'name' => 'TEST INDICATOR'],

        ];
}