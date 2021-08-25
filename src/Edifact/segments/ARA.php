<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Naam;
use mmerlijn\msg\src\Edifact\fields\Telefoon;

class ARA extends Segment
{
    protected static $name = 'ARA';
    protected static $structure = [
        1 => ['class' => Naam::class,  'opt' => 'M', 'name' => 'Naam persoon'],
        2 => ['class' => Telefoon::class,  'opt' => 'C', 'name' => 'Telefoon'],

    ];
}