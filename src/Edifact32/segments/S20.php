<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C286;
use mmerlijn\msg\src\Edifact32\fields\C529;

class S20 extends Segment
{
    protected static $name = 'S20';
    protected static $structure = [
        1 => ['class' => C286::class,  'opt' => 'M', 'name' => 'SEQUENCE INFORMATION'],
        2 => ['class' => C529::class,  'opt' => 'C', 'name' => 'PROCESSING INDICATOR'],

    ];
}