<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Artsnaam extends Field
{
    use ParentFieldTrait;
    protected static $name = 'Artsnaam';
    protected static $structure = [
        1 => ['class' => Achternaam::class, 'opt' => 'M', 'name' => 'Achternaam'],
        2 => ['class' => Voorvoegsels::class, 'opt' => 'M', 'name' => 'Voorvoegsels'],
        3 => ['class' => Voorletters::class, 'opt' => 'M', 'name' => 'Voorletters'],
        4 => ['class' => Titels::class, 'opt' => 'M', 'name' => 'Titels'],


    ];
}