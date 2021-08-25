<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:02
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0190;
use mmerlijn\msg\src\Hl7\tables\Table0399;

class AD extends Field
{
    use parentFieldTrait;
    protected static $name = 'AD';
    protected static $structure = [
        1 => ['class' => ST::class, 'length' => 120, 'opt' => 'O', 'name' => 'Street Address'],
        2 => ['class' => ST::class, 'length' => 120, 'opt' => 'O', 'name' => 'Other Designation'],
        3 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'City'],
        4 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'State Or Province'],
        5 => ['class' => ST::class, 'length' => 12, 'opt' => 'O', 'name' => 'Zip Or Postal Code'],
        6 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'name' => 'Country', 'table' => Table0399::class],
        7 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'name' => 'Address Type', 'table' => Table0190::class],
        8 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Other Geographic Designation'],

    ];
}