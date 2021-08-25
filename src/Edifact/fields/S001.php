<?php


namespace mmerlijn\msg\src\Edifact\fields;

class S001 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'S001';
    protected static $structure = [
        1 => ['class' => F0001::class, 'opt' => 'M', 'name' => 'Syntax identifier'],
        2 => ['class' => F0002::class, 'opt' => 'M', 'name' => 'Syntax version number'],


    ];
}