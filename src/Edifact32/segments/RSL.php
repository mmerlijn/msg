<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C830;
use mmerlijn\msg\src\Edifact32\fields\C848;
use mmerlijn\msg\src\Edifact32\fields\F7853;
use mmerlijn\msg\src\Edifact32\fields\F7857;

class RSL extends Segment
{
    protected static $name = 'RSL';
    protected static $structure = [
        1 => ['class' => F7853::class,  'opt' => 'M', 'name' => 'RESULT TYPE, CODED'],
        2 => ['class' => C830::class,  'opt' => 'M', 'name' => 'RESULT VALUE DETAILS'],
        3 => ['class' => C830::class,  'opt' => 'M', 'name' => 'RESULT VALUE DETAILS'],
        4 => ['class' => C848::class,  'opt' => 'C', 'name' => 'MEASUREMENT UNIT DETAILS'],
        5 => ['class' => F7857::class,  'opt' => 'C', 'name' => 'RESPONSE TYPE CODE'],


    ];
}