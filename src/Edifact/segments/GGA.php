<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Adres;
use mmerlijn\msg\src\Edifact\fields\F0078;
use mmerlijn\msg\src\Edifact\fields\Naam;
use mmerlijn\msg\src\Edifact\fields\Telefoon;

class GGA extends Segment
{
    protected static $name = 'GGA';
    protected static $structure = [
        1 => ['class' => Naam::class,  'opt' => 'M', 'name' => 'Naam Persoon'],
        2 => ['class' => F0078::class,  'opt' => 'C', 'name' => 'Afdeling'],
        3 => ['class' => Naam::class,  'opt' => 'C', 'name' => 'Naam Instelling'],
        4 => ['class' => Adres::class,  'opt' => 'C', 'name' => 'Adres'],
        5 => ['class' => Telefoon::class,  'opt' => 'C', 'name' => 'Telefoon'],
    ];
}