<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C090 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C090';
    protected static $structure = [
        1 => ['class' => F3477::class, 'opt' => 'C', 'name' => ' Address format code'],
        2 => ['class' => F3286::class, 'opt' => 'C', 'name' => 'Address component description'],
        3 => ['class' => F3286::class, 'opt' => 'C', 'name' => 'Address component description'],
        4 => ['class' => F3286::class, 'opt' => 'C', 'name' => 'Address component description'],
        5 => ['class' => F3286::class, 'opt' => 'C', 'name' => 'Address component description'],
        6 => ['class' => F3286::class, 'opt' => 'C', 'name' => 'Address component description'],


    ];
}