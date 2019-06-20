<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Tijd extends Field
{
    use ParentFieldTrait;
    protected static $name = 'Tijd';
    protected static $structure = [
        1 => ['class' => Uur::class, 'opt' => 'M', 'name' => 'Uur'],
        2 => ['class' => Minuut::class, 'opt' => 'M', 'name' => 'Minuut'],
        ];
}