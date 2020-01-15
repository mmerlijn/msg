<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class S009 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'S009';
    protected static $structure = [
        1 => ['class' => F0065::class, 'opt' => 'M', 'name' => 'Message type '],
        2 => ['class' => F0052::class, 'opt' => 'M', 'name' => 'Message version number'],
        3 => ['class' => F0054::class, 'opt' => 'M', 'name' => 'Message release number'],
        4 => ['class' => F0051::class, 'opt' => 'M', 'name' => 'Controlling agency'],
        5 => ['class' => F0057::class, 'opt' => 'C', 'name' => 'Association assigned code'],
    ];
}