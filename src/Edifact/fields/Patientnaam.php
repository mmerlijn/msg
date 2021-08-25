<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Patientnaam extends Field
{
    use ParentFieldTrait;
    protected static $name = 'Patientnaam';
    protected static $structure = [
        1 => ['class' => Achternaam::class, 'opt' => 'C', 'name' => 'mansnaam'],
        2 => ['class' => Voorvoegsels::class, 'opt' => 'C', 'name' => 'Voorvoegsel mansnaam'],
        3 => ['class' => Achternaam::class, 'opt' => 'C', 'name' => 'meisjesnaam'],
        4 => ['class' => Voorvoegsels::class, 'opt' => 'C', 'name' => 'Voorvoegsel meisjesnaam'],
        5 => ['class' => Voornaam::class, 'opt' => 'C', 'name' => 'Voornaam'],
        6 => ['class' => Voorletters::class, 'opt' => 'C', 'name' => 'Voorletters'],
    ];
}