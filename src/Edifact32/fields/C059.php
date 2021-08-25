<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C059 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C059';
    protected static $structure = [
        1 => ['class' => F3042::class, 'opt' => 'C', 'name' => 'Street and number or post office box identifier'],
        2 => ['class' => F3042::class, 'opt' => 'C', 'name' => 'Street and number or post office box identifier'],
        3 => ['class' => F3042::class, 'opt' => 'C', 'name' => 'Street and number or post office box identifier'],
        4 => ['class' => F3042::class, 'opt' => 'C', 'name' => 'Street and number or post office box identifier'],

    ];
}