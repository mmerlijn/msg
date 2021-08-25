<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 11:58
 */

namespace mmerlijn\msg\src\Hl7\fields;


class FNF extends Field
{
    use parentFieldTrait;
    protected static $name = 'FN';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Surname'],
        2 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Own Surname Prefix'],
        3 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Own Surname'],
        4 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Surname Prefix From Partner/Spouse'],
        5 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Surname From Partner/Spouse'],

    ];

}