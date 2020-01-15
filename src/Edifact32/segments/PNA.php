<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C206;
use mmerlijn\msg\src\Edifact32\fields\C816;
use mmerlijn\msg\src\Edifact32\fields\F3035;
use mmerlijn\msg\src\Edifact32\fields\F3797;

class PNA extends Segment
{
    protected static $name = 'PNA';
    protected static $structure = [
        1 => ['class' => F3035::class,  'opt' => 'M', 'name' => 'PARTY QUALIFIER'],
        2 => ['class' => C206::class,  'opt' => 'C', 'name' => 'IDENTIFICATION NUMBER'],
        3 => ['class' => F3797::class,  'opt' => 'C', 'name' => 'NAME TYPE, CODED'],
        4 => ['class' => F3797::class,  'opt' => 'C', 'name' => 'NAME STATUS, CODED'],
        5 => ['class' => C816::class,  'opt' => 'C', 'name' => 'NAME COMPONENT DETAILS'],
        6 => ['class' => C816::class,  'opt' => 'C', 'name' => 'NAME COMPONENT DETAILS'],
        7 => ['class' => C816::class,  'opt' => 'C', 'name' => 'NAME COMPONENT DETAILS'],
        8 => ['class' => C816::class,  'opt' => 'C', 'name' => 'NAME COMPONENT DETAILS'],
        9 => ['class' => C816::class,  'opt' => 'C', 'name' => 'NAME COMPONENT DETAILS'],
    ];
}