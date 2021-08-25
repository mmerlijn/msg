<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 29-1-2019
 * Time: 21:45
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0333;

class DLN extends Field
{
    use parentFieldTrait;
    protected static $name = 'DLN';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 20, 'opt' => 'R', 'name' => 'Drivers License Number'],
        2 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'table' => Table0333::class, 'name' => 'Issuing State, Province, Country'],
        3 => ['class' => DT::class, 'length' => 24, 'opt' => 'O', 'name' => 'Expiration Date'],

    ];
}