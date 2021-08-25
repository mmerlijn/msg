<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C107 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C107';
    protected static $structure = [
        1 => ['class' => F4441::class, 'opt' => 'C', 'name' => 'Free text, coded'],
        2 => ['class' => F1131::class, 'opt' => 'C', 'name' => 'Code list qualifier'],
        3 => ['class' => F3035::class, 'opt' => 'C', 'name' => 'Code list resp.ag., coded '],

    ];
}