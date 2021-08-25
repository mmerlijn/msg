<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Naam;
use mmerlijn\msg\src\Edifact\fields\Telefoon;

class AFD extends Segment
{
    protected static $name = 'AFD';
    protected static $structure = [
        1 => ['class' => Naam::class,  'opt' => 'M', 'name' => 'Afdeling'],
        2 => ['class' => Telefoon::class,  'opt' => 'C', 'name' => 'Telefoon'],

    ];
}