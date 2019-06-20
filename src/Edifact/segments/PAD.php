<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Adres;
use mmerlijn\msg\src\Edifact\fields\Telefoon;

class PAD extends Segment
{
    protected static $name = 'PAD';
    protected static $structure = [
        1 => ['class' => Adres::class,  'opt' => 'M', 'name' => 'Adres'],
        2 => ['class' => Telefoon::class,  'opt' => 'M', 'name' => 'Telefoon'],

    ];
}