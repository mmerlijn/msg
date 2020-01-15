<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C058 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C058';
    protected static $structure = [
        1 => ['class' => F3124::class, 'opt' => 'M', 'name' => 'Name and address description'],
        2 => ['class' => F3124::class, 'opt' => 'C', 'name' => 'Name and address description'],
        3 => ['class' => F3124::class, 'opt' => 'C', 'name' => 'Name and address description'],
        4 => ['class' => F3124::class, 'opt' => 'C', 'name' => 'Name and address description'],
        5 => ['class' => F3124::class, 'opt' => 'C', 'name' => 'Name and address description'],

    ];
}