<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C817 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C817';
    protected static $structure = [
        1 => ['class' => F3299::class, 'opt' => 'M', 'name' => 'Address purpose code'],
        2 => ['class' => F3131::class, 'opt' => 'C', 'name' => 'Address type code'],
        3 => ['class' => F3475::class, 'opt' => 'C', 'name' => 'Address status code'],


    ];
}