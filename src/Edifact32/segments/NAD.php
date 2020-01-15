<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C058;
use mmerlijn\msg\src\Edifact32\fields\C059;
use mmerlijn\msg\src\Edifact32\fields\C080;
use mmerlijn\msg\src\Edifact32\fields\C082;
use mmerlijn\msg\src\Edifact32\fields\C819;
use mmerlijn\msg\src\Edifact32\fields\F3035;
use mmerlijn\msg\src\Edifact32\fields\F3164;
use mmerlijn\msg\src\Edifact32\fields\F3207;
use mmerlijn\msg\src\Edifact32\fields\F3251;

class NAD extends Segment
{
    protected static $name = 'NAD';
    protected static $structure = [
        1 => ['class' => F3035::class,  'opt' => 'M', 'name' => 'PARTY FUNCTION CODE QUALIFIER'],
        2 => ['class' => C082::class,  'opt' => 'C', 'name' => 'PARTY IDENTIFICATION DETAILS'],
        3 => ['class' => C058::class,  'opt' => 'C', 'name' => 'NAME AND ADDRESS'],
        4 => ['class' => C080::class,  'opt' => 'C', 'name' => 'PARTY NAME'],
        5 => ['class' => C059::class,  'opt' => 'C', 'name' => 'STREET  '],
        6 => ['class' => F3164::class,  'opt' => 'C', 'name' => 'CITY NAME'],
        7 => ['class' => C819::class,  'opt' => 'C', 'name' => 'COUNTRY SUBDIVISION DETAILS'],
        8 => ['class' => F3251::class,  'opt' => 'C', 'name' => 'POSTAL IDENTIFICATION CODE'],
        9 => ['class' => F3207::class,  'opt' => 'C', 'name' => 'COUNTRY IDENTIFIER'],

    ];
}