<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C286;

class S06 extends Segment
{
    protected static $name = 'S06';
    protected static $structure = [
        1 => ['class' => C286::class,  'opt' => 'M', 'name' => 'SEQUENCE INFORMATION'],

    ];
}