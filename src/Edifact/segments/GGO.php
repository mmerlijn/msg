<?php


namespace mmerlijn\msg\src\Edifact\segments;



use mmerlijn\msg\src\Edifact\fields\Adres;
use mmerlijn\msg\src\Edifact\fields\F0078;
use mmerlijn\msg\src\Edifact\fields\Naam;
use mmerlijn\msg\src\Edifact\fields\Telefoon;

class GGO extends Segment
{
    protected static $name = 'GGO';
    protected static $structure = [
        1 => ['class' => Naam::class,  'opt' => 'M', 'name' => 'Naam persoon'],
        2 => ['class' => F0078::class,  'opt' => 'C', 'name' => 'Afdeling'],
        3 => ['class' => Naam::class,  'opt' => 'C', 'name' => 'Naam instelling'],
        4 => ['class' => Adres::class,  'opt' => 'C', 'name' => 'Adres'],
        5 => ['class' => Telefoon::class,  'opt' => 'C', 'name' => 'Telefoon'],
    ];
}