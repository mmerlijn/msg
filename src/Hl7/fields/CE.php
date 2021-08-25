<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 15:39
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0190;
use mmerlijn\msg\src\Hl7\tables\Table0396;

class CE extends Field
{
    use parentFieldTrait;
    public static $name = 'CE';
    protected static $structure = [
        1 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Identifier'],
        2 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Text'],
        3 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Name Of Coding System', 'table' => Table0396::class],
        4 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Alternate Identifier'],
        5 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Alternate Text'],
        6 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Name Of Alternate Coding System', 'table' => Table0396::class],

    ];
}