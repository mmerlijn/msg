<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C848 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C848';
    protected static $structure = [
        1 => ['class' => F6411::class,  'opt' => 'C', 'name' => 'Measurement unit identification'],
        2 => ['class' => F1131::class,  'opt' => 'C', 'name' => 'Code list qualifier'],
        3 => ['class' => F3055::class,  'opt' => 'C', 'name' => 'Code list resp. agency, coded'],
        4 => ['class' => F6410::class,  'opt' => 'C', 'name' => 'Measurement unit'],

    ];
}