<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Datum extends Field
{
    use ParentFieldTrait;
    protected static $name = 'Datum';
    protected static $structure = [
        1 => ['class' => Jaar::class, 'opt' => 'M', 'name' => 'Jaar'],
        2 => ['class' => Maand::class, 'opt' => 'M', 'name' => 'Maand'],
        3 => ['class' => Dag::class, 'opt' => 'M', 'name' => 'Dag'],
        ];
}