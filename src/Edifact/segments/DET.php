<?php


namespace mmerlijn\msg\src\Edifact\segments;



use mmerlijn\msg\src\Edifact\fields\Datum;
use mmerlijn\msg\src\Edifact\fields\Tijd;

class DET extends Segment
{
    protected static $name = 'DET';
    protected static $structure = [
        1 => ['class' => Datum::class,  'opt' => 'M', 'name' => 'Datum'],
        2 => ['class' => Tijd::class,  'opt' => 'C', 'name' => 'Tijd'],

    ];
}