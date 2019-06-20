<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Bepaling;

class NUB extends Segment
{
    protected static $name = 'NUB';
    protected static $structure = [
        1 => ['class' => Bepaling::class,  'opt' => 'M', 'name' => 'Bepaling'],
    ];
}