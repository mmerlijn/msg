<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Artscode;
use mmerlijn\msg\src\Edifact\fields\F0078;
use mmerlijn\msg\src\Edifact\fields\Naam;

class SPE extends Segment
{
    protected static $name = 'SPE';
    protected static $structure = [
        1 => ['class' => F0078::class,  'opt' => 'M', 'name' => 'Specialistme'],
        1 => ['class' => Naam::class,  'opt' => 'C', 'name' => 'Naam persoon'],
        1 => ['class' => Artscode::class,  'opt' => 'C', 'name' => 'Artscode'],

    ];
}