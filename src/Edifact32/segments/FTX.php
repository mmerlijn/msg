<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C107;
use mmerlijn\msg\src\Edifact32\fields\C108;
use mmerlijn\msg\src\Edifact32\fields\F3453;
use mmerlijn\msg\src\Edifact32\fields\F4451;
use mmerlijn\msg\src\Edifact32\fields\F4453;

class FTX extends Segment
{
    protected static $name = 'FTX';
    protected static $structure = [
        1 => ['class' => F4451::class,  'opt' => 'M', 'name' => 'TEXT SUBJECT QUALIFIER'],
        2 => ['class' => F4453::class,  'opt' => 'C', 'name' => 'TEXT FUNCTION, CODED'],
        3 => ['class' => C107::class,  'opt' => 'C', 'name' => 'TEXT REFERENCE '],
        4 => ['class' => C108::class,  'opt' => 'C', 'name' => 'TEXT LITERAL'],
        5 => ['class' => F3453::class,  'opt' => 'C', 'name' => 'LANGUAGE, CODED'],


    ];
}