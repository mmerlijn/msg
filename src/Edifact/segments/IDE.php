<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\CodeCompleet;
use mmerlijn\msg\src\Edifact\fields\Identificatienummer;
use mmerlijn\msg\src\Edifact\fields\Materiaalsoort;
use mmerlijn\msg\src\Edifact\fields\Materiaalvolume;

class IDE extends Segment
{
    protected static $name = 'IDE';
    protected static $structure = [
        1 => ['class' => CodeCompleet::class,  'opt' => 'M', 'name' => 'Code compleet'],
        2 => ['class' => Identificatienummer::class,  'opt' => 'M', 'name' => 'Identificatienummer'],
        3 => ['class' => Materiaalsoort::class,  'opt' => 'C', 'name' => 'Materiaalsoort'],
        4 => ['class' => Materiaalvolume::class,  'opt' => 'C', 'name' => 'Materiaalvolume'],

    ];
}