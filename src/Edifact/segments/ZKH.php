<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Adres;
use mmerlijn\msg\src\Edifact\fields\Naam;
use mmerlijn\msg\src\Edifact\fields\Telefoon;
use mmerlijn\msg\src\Edifact\fields\Ziekenhuiscode;

class ZKH extends Segment
{
    protected static $name = 'ZKH';
    protected static $structure = [
        1 => ['class' => Naam::class,  'opt' => 'M', 'name' => 'Naam Instelling'],
        2 => ['class' => Adres::class,  'opt' => 'C', 'name' => 'Adres'],
        3 => ['class' => Telefoon::class,  'opt' => 'C', 'name' => 'Telefoon'],
        4 => ['class' => Ziekenhuiscode::class,  'opt' => 'C', 'name' => 'Ziekenhuiscode'],
        ];
}