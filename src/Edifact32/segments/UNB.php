<?php
//version synthax rules

namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\F0020;
use mmerlijn\msg\src\Edifact32\fields\S001;
use mmerlijn\msg\src\Edifact32\fields\S002;
use mmerlijn\msg\src\Edifact32\fields\S003;
use mmerlijn\msg\src\Edifact32\fields\S004;
use mmerlijn\msg\src\Edifact32\fields\F0036;


//MANDATORY M
//OPTIONAL  O Indicates that the entity is optional and may be sent at the discretion of the user

//type F=fixed O=variable (length specification
class UNB extends Segment
{
    protected static $name = 'UNB';
    protected static $structure = [
        1 => ['class' => S001::class,  'opt' => 'M', 'name' => 'Syntax identifier Versie'],
        2 => ['class' => S002::class,  'opt' => 'M', 'name' => 'INTERCHANGE SENDER ID'],
        3 => ['class' => S003::class,  'opt' => 'M', 'name' => 'INTERCHANGE RECIPIENT ID'],
        4 => ['class' => S004::class,  'opt' => 'M', 'name' => 'DATE/TIME OF INTERCHANGE'],
        5 => ['class' => F0020::class,  'opt' => 'M', 'name' => 'Identificatie van de interchange'],
        6 => ['class' => F0020::class,  'opt' => 'M', 'name' => ''],
        7 => ['class' => F0036::class,  'opt' => 'M', 'name' => 'aantal berichten'],
        ];
}