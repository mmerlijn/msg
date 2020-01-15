<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C832 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C832';
    protected static $structure = [
        1 => ['class' => F7867::class,  'opt' => 'C', 'name' => 'specimen characteristic identification'],
        2 => ['class' => F1131::class,  'opt' => 'C', 'name' => 'Code list qualifier'],
        3 => ['class' => F3055::class,  'opt' => 'C', 'name' => 'Code list resp. agency, coded'],
        4 => ['class' => F7866::class,  'opt' => 'C', 'name' => 'Specimen characteristic'],
    ];
}