<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0078;

class SEC extends Segment
{
    protected static $name = 'SEC';
    protected static $structure = [
        1 => ['class' => F0078::class,  'opt' => 'M', 'name' => 'Sectienaam (splitsing in bericht)'],

    ];
}