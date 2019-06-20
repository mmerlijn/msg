<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 16:23
 */

namespace mmerlijn\msg\src\Hl7\fields;




class CWE extends Field
{
    use parentFieldTrait;
    protected static $name = 'CWE';
    protected static $structure = [
        1 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Identifier'],
        2 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Text'],
        3 => ['class' => ID::class, 'length' => 20, 'opt' => 'O', 'name' => 'Name Of Coding System', 'table' => Table0396::class],
        4 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Alternate Identifier'],
        5 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Alternate Text'],
        6 => ['class' => ID::class, 'length' => 20, 'opt' => 'O', 'name' => 'Name Of Alternate Coding System', 'table' => Table0396::class],
        7 => ['class' => ST::class, 'length' => 10, 'opt' => 'C', 'name' => 'Coding System Version Id'],
        8 => ['class' => ST::class, 'length' => 10, 'opt' => 'O', 'name' => 'Alternate Coding System Version Id'],
        9 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Original Text'],

    ];
}