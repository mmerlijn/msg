<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\F3917;

class PDI extends Segment
{
    protected static $name = 'PDI';
    protected static $structure = [
        1 => ['class' => F3917::class,  'opt' => 'M', 'name' => 'Sex, coded'],

    ];
}