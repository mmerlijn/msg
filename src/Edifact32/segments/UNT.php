<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\F0062;
use mmerlijn\msg\src\Edifact32\fields\F0074;

class UNT extends Segment
{
    protected static $name = 'UNT';
    protected static $structure = [
        1 => ['class' => F0074::class,  'opt' => 'M', 'name' => 'NUMBER OF SEGMENTS IN THE MESSAGE'],
        2 => ['class' => F0062::class,  'opt' => 'M', 'name' => 'MESSAGE REFERENCE NUMBER'],
    ];
}