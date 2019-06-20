<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:17
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0335;

class RI extends Field
{
    use parentFieldTrait;
    protected static $name = 'RI';
    protected static $structure = [
        1 => ['class' => IS::class, 'length' => 6, 'opt' => 'O', 'name' => 'Repeat Pattern', 'table' => Table0335::class],
        2 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Explicit Time Interval'],


    ];
}