<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C507 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C0507';
    protected static $structure = [
        1 => ['class' => F2005::class,  'opt' => 'M', 'name' => 'Date or time or period function code qualifier'],
        2 => ['class' => F2380::class,  'opt' => 'C', 'name' => 'Date or time or period text'],
        3 => ['class' => F2379::class,  'opt' => 'C', 'name' => 'Date or time or period format code'],



    ];
}