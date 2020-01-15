<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C076 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C076';
    protected static $structure = [
        1 => ['class' => F3148::class,  'opt' => 'C', 'name' => 'Communication number '],
        2 => ['class' => F3155::class,  'opt' => 'C', 'name' => 'Communication channel qual.'],
    ];

}