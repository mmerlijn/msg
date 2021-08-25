<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C108 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C108';
    protected static $structure = [
        1 => ['class' => F4440::class, 'opt' => 'C', 'name' => 'Free text'],
        2 => ['class' => F4440::class, 'opt' => 'C', 'name' => 'Free text'],
        3 => ['class' => F4440::class, 'opt' => 'C', 'name' => 'Free text'],
        4 => ['class' => F4440::class, 'opt' => 'C', 'name' => 'Free text'],
        5 => ['class' => F4440::class, 'opt' => 'C', 'name' => 'Free text'],


    ];
}