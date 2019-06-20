<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0078;

class OPU extends Segment
{
    protected static $name = 'OPU';
    protected static $structure = [
        1 => ['class' => F0078::class,  'opt' => 'M', 'name' => 'Opmerking uit te voeren laboratoriumbepaling'],

    ];
}