<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0078;

class OPB extends Segment
{
    protected static $name = 'OPB';
    protected static $structure = [
        1 => ['class' => F0078::class,  'opt' => 'M', 'name' => 'FREE FORM TEXT'],
    ];
}