<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 21:51
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0190;
use mmerlijn\msg\src\Hl7\tables\Table0288;
use mmerlijn\msg\src\Hl7\tables\Table0289;
use mmerlijn\msg\src\Hl7\tables\Table0399;
use mmerlijn\msg\src\Hl7\tables\Table0465;

class XAD extends Field
{
    use parentFieldTrait;
    protected static $name = 'XAD';
    private static $structure = [
        1 => ['class' => SAD::class, 'length' => 184, 'opt' => 'O', 'name' => 'Street Address'],
        2 => ['class' => ST::class, 'length' => 120, 'opt' => 'O', 'name' => 'Other Designation'],
        3 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'City'],
        4 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'State Or Province'],
        5 => ['class' => ST::class, 'length' => 12, 'opt' => 'O', 'name' => 'Zip Or Postal Code'],
        6 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'table' => Table0399::class, 'name' => 'Country'],
        7 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'table' => Table0190::class, 'name' => 'Address Type'],
        8 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Other Geographic Designation'],
        9 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'table' => Table0289::class, 'name' => 'County/Parish Code'],
        10 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'table' => Table0288::class, 'name' => 'Census Tract'],
        11 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'table' => Table0465::class, 'name' => 'Address Representation Code'],
        12 => ['class' => DR::class, 'length' => 53, 'opt' => 'B', 'name' => 'Address Validity Range'],
    ];

}