<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class S010 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'S005';
    protected static $structure = [
        1 => ['class' => F0070::class, 'opt' => 'M', 'name' => 'Message type '],
        2 => ['class' => F0073::class, 'opt' => 'C', 'name' => 'Message version number'],

    ];
}