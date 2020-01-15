<?php


namespace mmerlijn\msg\src\Edifact32\fields;

class S004 extends Field
{
    use ParentFieldTrait;

    protected static $name = 'S004';
    protected static $structure = [
        1 => ['class' => F0017::class, 'opt' => 'M', 'name' => 'Date'],
        2 => ['class' => F0019::class, 'opt' => 'M', 'name' => 'Time'],
    ];
}