<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Adres extends Field
{
    use ParentFieldTrait;
    protected static $name = 'Adres';
    protected static $structure = [
        1 => ['class' => Straatnaam::class, 'opt' => 'M', 'name' => 'Straatnaam'],
        2 => ['class' => Huisnr::class, 'opt' => 'C', 'name' => 'Huisnr'],
        3 => ['class' => Postbus::class, 'opt' => 'C', 'name' => 'Postbus'],
        4 => ['class' => Woonplaats::class, 'opt' => 'M', 'name' => 'Woonplaats'],
        5 => ['class' => Postcode::class, 'opt' => 'C', 'name' => 'Postcode'],
        6 => ['class' => Provincie::class, 'opt' => 'C', 'name' => 'Provincie'],
        7 => ['class' => Land::class, 'opt' => 'C', 'name' => 'Land'],
    ];
}