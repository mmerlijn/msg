<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C080 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C080';
    protected static $structure = [
        1 => ['class' => F3036::class, 'opt' => 'C', 'name' => 'Party name'],
        2 => ['class' => F3036::class, 'opt' => 'C', 'name' => 'Party name'],
        3 => ['class' => F3036::class, 'opt' => 'C', 'name' => 'Party name'],
        4 => ['class' => F3036::class, 'opt' => 'C', 'name' => 'Party name'],
        5 => ['class' => F3036::class, 'opt' => 'C', 'name' => 'Party name'],
        6 => ['class' => F3045::class, 'opt' => 'C', 'name' => 'Party name format code'],

    ];
}