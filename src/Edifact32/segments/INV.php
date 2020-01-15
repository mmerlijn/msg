<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C847;
use mmerlijn\msg\src\Edifact32\fields\F9927;

class INV extends Segment
{
    protected static $name = 'INV';
    protected static $structure = [
        1 => ['class' => F9927::class,  'opt' => 'M', 'name' => 'INVESTIGATION CHARACTERISTIC QUALIFIER'],
        2 => ['class' => C847::class,  'opt' => 'M', 'name' => 'INVESTIGATION CHARACTERISTIC DETAILS'],

    ];
}