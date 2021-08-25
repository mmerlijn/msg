<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:06
 */
namespace mmerlijn\msg\src\Hl7\fields;


class MO extends Field
{
    use parentFieldTrait;
    protected static $name = 'MO';
    protected static $structure = [
        1 => ['class' => NM::class, 'length' => 16, 'opt' => 'O', 'name' => 'Quantity'],
        2 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'name' => 'Denomination'],


    ];
}