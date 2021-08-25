<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C819 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C819';
    protected static $structure = [
        1 => ['class' => F3229::class, 'opt' => 'C', 'name' => 'Country subdivision identifier'],
        2 => ['class' => F1131::class, 'opt' => 'C', 'name' => 'Code list identification code'],
        3 => ['class' => F3055::class, 'opt' => 'C', 'name' => 'Code list responsible agency code'],
       // 4 => ['class' => F3228::class, 'opt' => 'C', 'name' => 'Country subdivision name'],
    ];
}