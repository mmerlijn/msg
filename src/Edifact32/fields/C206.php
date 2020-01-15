<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C206 extends Field
{

    use ParentFieldTrait;
    protected static $name = 'C206';
    protected static $structure = [
        1 => ['class' => F7402::class, 'opt' => 'M', 'name' => 'Identity number'],
        2 => ['class' => F7405::class, 'opt' => 'C', 'name' => 'Identity number qualifier'],
        3 => ['class' => F3039::class, 'opt' => 'C', 'name' => 'Party id identification'],
        4 => ['class' => F1131::class, 'opt' => 'C', 'name' => 'Code list qualifier'],
        5 => ['class' => F3055::class, 'opt' => 'C', 'name' => 'Code list responsible agency, coded'],
        6 => ['class' => F4405::class, 'opt' => 'C', 'name' => 'Status, coded'],

    ];
}