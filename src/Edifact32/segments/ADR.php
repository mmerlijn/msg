<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C090;
use mmerlijn\msg\src\Edifact32\fields\C517;
use mmerlijn\msg\src\Edifact32\fields\C817;
use mmerlijn\msg\src\Edifact32\fields\C819;
use mmerlijn\msg\src\Edifact32\fields\F3164;
use mmerlijn\msg\src\Edifact32\fields\F3207;
use mmerlijn\msg\src\Edifact32\fields\F3251;

class ADR extends Segment
{
    protected static $name = 'ADR';
    protected static $structure = [
        1 => ['class' => C817::class,  'opt' => 'C', 'name' => 'ADDRESS USAGE'],
        2 => ['class' => C090::class,  'opt' => 'C', 'name' => 'ADDRESS DETAILS'],
        3 => ['class' => F3164::class,  'opt' => 'C', 'name' => 'CITY NAME'],
        4 => ['class' => F3251::class,  'opt' => 'C', 'name' => 'POSTAL IDENTIFICATION CODE'],
        5 => ['class' => F3207::class,  'opt' => 'C', 'name' => 'COUNTRY IDENTIFIER'],
        6 => ['class' => C819::class,  'opt' => 'C', 'name' => 'COUNTRY SUBDIVISION DETAILS'],
        7 => ['class' => C517::class,  'opt' => 'C', 'name' => 'LOCATION IDENTIFICATION '],

    ];
}