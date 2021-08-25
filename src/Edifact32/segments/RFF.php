<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C506;

class RFF extends Segment
{
    protected static $name = 'RFF';
    protected static $structure = [
        1 => ['class' => C506::class,  'opt' => 'M', 'name' => 'REFERENCE'],

    ];
}