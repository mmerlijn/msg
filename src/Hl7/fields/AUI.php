<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:43
 */

namespace mmerlijn\msg\src\Hl7\fields;



class AUI
{
    use parentFieldTrait;
    protected static $name = 'AUI';
    protected static $structure = [
        1 => ['class' => ST::class, 'length' => 30, 'opt' => 'O', 'name' => 'Authorization Number'],
        2 => ['class' => DT::class, 'length' => 8, 'opt' => 'O', 'name' => 'Date'],
        3 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Source'],

    ];
}