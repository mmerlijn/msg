<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0020;
use mmerlijn\msg\src\Edifact\fields\F0036;

class UNZ extends Segment
{
    protected static $name = 'UNZ';
    protected static $structure = [
        1 => ['class' => F0036::class,  'opt' => 'M', 'name' => 'INTERCHANGE CONTROL COUNT'],
        2 => ['class' => F0020::class,  'opt' => 'M', 'name' => 'INTERCHANGE CONTROL REFERENCE'],
    ];
}