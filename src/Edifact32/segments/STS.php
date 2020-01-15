<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\F1131;
use mmerlijn\msg\src\Edifact32\fields\F3055;
use mmerlijn\msg\src\Edifact32\fields\F4405;

class STS extends Segment
{
    protected static $name = 'STS';
    protected static $structure = [
        1 => ['class' => F4405::class,  'opt' => 'M', 'name' => 'Status description code'],
        2 => ['class' => F1131::class,  'opt' => 'M', 'name' => 'Code list identification code '],
        3 => ['class' => F3055::class,  'opt' => 'M', 'name' => 'Code list responsible agency code '],
       // 4 => ['class' => F4404::class,  'opt' => 'M', 'name' => 'Status description '],

    ];
}