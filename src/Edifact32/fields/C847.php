<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C847 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C847';
    protected static $structure = [
        1 => ['class' => F9931::class,  'opt' => 'C', 'name' => 'Investigation characteristic identification'],
        2 => ['class' => F1131::class,  'opt' => 'C', 'name' => 'Code list qualifier'],
        3 => ['class' => F3055::class,  'opt' => 'C', 'name' => 'Code list resp. agency, coded'],
        4 => ['class' => F9930::class,  'opt' => 'C', 'name' => 'Investigation characteristic'],
    ];
}