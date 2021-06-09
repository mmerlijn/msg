<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0077;
use mmerlijn\msg\src\Edifact\fields\F0078;

class TXT extends Segment
{
    protected static $name = 'TXT';
    protected static $structure = [
   //     1 => ['class' => F0077::class,  'opt' => 'C', 'name' => 'TEXT REFERENCE CODE'],
        1 => ['class' => F0078::class,  'opt' => 'M', 'name' => 'FREE FORM TEXT'],
    ];
}