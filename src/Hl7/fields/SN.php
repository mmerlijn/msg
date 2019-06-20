<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:14
 */
namespace mmerlijn\msg\src\Hl7\fields;


class SN extends Field
{
    use parentFieldTrait;
    protected static $name = 'SN';
    protected static $structure = [
        1 => ['class' => ST::class, 'length' => 2, 'opt' => 'O', 'name' => 'Comparator'],
        2 => ['class' => NM::class, 'length' => 15, 'opt' => 'O', 'name' => 'Num1'],
        3 => ['class' => ST::class, 'length' => 1, 'opt' => 'O', 'name' => 'Separator/Suffix'],
        4 => ['class' => NM::class, 'length' => 15, 'opt' => 'O', 'name' => 'Num2'],
    ];
}