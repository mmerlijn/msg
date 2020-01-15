<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C529 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C529';
    protected static $structure = [
        1 => ['class' => F7365::class, 'opt' => 'C', 'name' => 'Processing indicator, coded'],
        2 => ['class' => F1131::class, 'opt' => 'C', 'name' => 'Code list qualifier'],
        3 => ['class' => F3055::class, 'opt' => 'C', 'name' => 'Code list responsible agency, coded'],

    ];
}