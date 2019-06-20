<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 21:54
 */

namespace mmerlijn\msg\src\Hl7\fields;


class SAD extends Field
{
    use parentFieldTrait;
    protected static $name = 'SAD';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 120, 'opt' => 'O', 'name' => 'Street Or Mailing Address'],
        2 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Street Name'],
        3 => ['class' => ST::class, 'length' => 12, 'opt' => 'O', 'name' => 'Dwelling Number'],

    ];
}