<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C816 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C529';
    protected static $structure = [
        1 => ['class' => F3835::class, 'opt' => 'C', 'name' => 'Name component qualifier'],
        2 => ['class' => F3836::class, 'opt' => 'C', 'name' => 'Name component'],
        3 => ['class' => F3839::class, 'opt' => 'C', 'name' => 'Name component status, coded'],
        4 => ['class' => F3841::class, 'opt' => 'C', 'name' => 'Name component original representation, coded'],

    ];
}