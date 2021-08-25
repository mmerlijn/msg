<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C002;
use mmerlijn\msg\src\Edifact32\fields\F1004;
use mmerlijn\msg\src\Edifact32\fields\F1225;
use mmerlijn\msg\src\Edifact32\fields\F4343;

class BGM extends Segment
{
    protected static $name = 'BGM';
    protected static $structure = [
        1 => ['class' => C002::class,  'opt' => 'M', 'name' => 'DOCUMENT/MESSAGE NAME '],
        2 => ['class' => F1004::class,  'opt' => 'M', 'name' => 'DOCUMENT/MESSAGE NUMBER'],
        3 => ['class' => F1225::class,  'opt' => 'C', 'name' => 'MESSAGE FUNCTION CODE'],
        4 => ['class' => F4343::class,  'opt' => 'C', 'name' => 'RESPONSE TYPE CODE'],


    ];
}