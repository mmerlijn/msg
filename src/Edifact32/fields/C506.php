<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C506 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C506';
    protected static $structure = [
        1 => ['class' => F1153::class, 'opt' => 'C', 'name' => 'Reference qualifier'],
        2 => ['class' => F1154::class, 'opt' => 'C', 'name' => 'Reference number '],
        3 => ['class' => F1156::class, 'opt' => 'C', 'name' => 'Line number'],

    ];
}