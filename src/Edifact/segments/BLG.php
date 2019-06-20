<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Bloedgroep;

class BLG extends Segment
{
    protected static $name = 'BLG';
    protected static $structure = [
        1 => ['class' => Bloedgroep::class,  'opt' => 'M', 'name' => 'Bloedgroep'],

    ];
}