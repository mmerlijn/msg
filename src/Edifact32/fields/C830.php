<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C830 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C830';
    protected static $structure = [
        1 => ['class' => F6314::class,  'opt' => 'C', 'name' => 'Measurement value'],
        2 => ['class' => F6321::class,  'opt' => 'C', 'name' => 'Measurement significance, coded'],
        3 => ['class' => F6155::class,  'opt' => 'C', 'name' => 'Measurement attribute identification'],
        4 => ['class' => F1131::class,  'opt' => 'C', 'name' => 'Code list qualifier'],
        5 => ['class' => F3055::class,  'opt' => 'C', 'name' => 'Code list resp. agency, coded'],
        6 => ['class' => F7854::class,  'opt' => 'C', 'name' => 'Result value string'],
    ];
}