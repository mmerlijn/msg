<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Adres;
use mmerlijn\msg\src\Edifact\fields\Artscode;
use mmerlijn\msg\src\Edifact\fields\Artsnaam;
use mmerlijn\msg\src\Edifact\fields\SoortArts;
use mmerlijn\msg\src\Edifact\fields\Telefoon;

class ART extends Segment
{
    protected static $name = 'ART';
    protected static $structure = [
        1 => ['class' => SoortArts::class,  'opt' => 'M', 'name' => 'Soort Arts'],
        2 => ['class' => Artscode::class,  'opt' => 'M', 'name' => 'Artscode'],
        3 => ['class' => Artsnaam::class,  'opt' => 'M', 'name' => 'Artsnaam'],
        4 => ['class' => Adres::class,  'opt' => 'C', 'name' => 'Adres'],
        5 => ['class' => Telefoon::class,  'opt' => 'C', 'name' => 'Telefoon'],

    ];
}