<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Geboortedatum extends Field
{
    use ParentFieldTrait;
    protected static $name = 'Geboortedatum';
    protected static $structure = [
        1 => ['class' => Eeuwjaar::class, 'opt' => 'M', 'name' => 'Eeuwjaar'],
        2 => ['class' => Maand::class, 'opt' => 'M', 'name' => 'Maand'],
        3 => ['class' => Dag::class, 'opt' => 'M', 'name' => 'Dag'],


    ];
}