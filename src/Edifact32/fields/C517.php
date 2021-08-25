<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C517 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C517';
    protected static $structure = [
        1 => ['class' => F3225::class, 'opt' => 'C', 'name' => 'Country subdivision identifier'],
        2 => ['class' => F1131::class, 'opt' => 'C', 'name' => 'Code list identification code'],
        3 => ['class' => F3055::class, 'opt' => 'C', 'name' => 'Code list responsible agency code'],
    ];
}