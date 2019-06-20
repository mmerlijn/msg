<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\KopieRapport;
use mmerlijn\msg\src\Edifact\fields\Naam;

class KOP extends Segment
{
    protected static $name = 'KOP';
    protected static $structure = [
        1 => ['class' => KopieRapport::class,  'opt' => 'M', 'name' => 'Kopie rapport'],
        2 => ['class' => Naam::class,  'opt' => 'M', 'name' => 'Naam persoon'],
        3 => ['class' => Naam::class,  'opt' => 'C', 'name' => 'Naam persoon'],
        4 => ['class' => Naam::class,  'opt' => 'C', 'name' => 'Naam persoon'],
        5 => ['class' => Naam::class,  'opt' => 'C', 'name' => 'Naam persoon'],
        6 => ['class' => Naam::class,  'opt' => 'C', 'name' => 'Naam persoon'],

    ];
}