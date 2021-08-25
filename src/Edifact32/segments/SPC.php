<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C832;
use mmerlijn\msg\src\Edifact32\fields\F7863;

class SPC extends Segment
{
    protected static $name = 'SPC';
    protected static $structure = [
        1 => ['class' => F7863::class,  'opt' => 'M', 'name' => 'SPECIMEN CHARACTERISTIC QUALIFIER'],
        2 => ['class' => C832::class,  'opt' => 'M', 'name' => 'SPECIMEN CHARACTERISTIC DETAILS'],



    ];
}