<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0078;
use mmerlijn\msg\src\Edifact\fields\Field;

class COM extends Field
{
    protected static $name = 'COM';
    protected static $structure = [
        1 => ['class' => F0078::class,  'opt' => 'M', 'name' => 'Algemeen commentaar laboratorium'],

    ];
}