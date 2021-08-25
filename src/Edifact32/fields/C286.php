<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C286 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C506';
    protected static $structure = [
        1 => ['class' => F1050::class, 'opt' => 'C', 'name' => 'Sequence number'],
        2 => ['class' => F1159::class, 'opt' => 'C', 'name' => 'Sequence number source, coded '],
        3 => ['class' => F1131::class, 'opt' => 'C', 'name' => 'Code list qualifier'],
        4 => ['class' => F3055::class, 'opt' => 'C', 'name' => 'Code list responsible agency, coded'],

    ];
}