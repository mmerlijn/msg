<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:15
 */

namespace mmerlijn\msg\src\Hl7\fields;


class CQ extends Field
{
    use parentFieldTrait;
    protected static $name = 'CQ';
    protected static $structure = [
        1 => ['class' => NM::class, 'length' => 16, 'opt' => 'O', 'name' => 'Quantity'],
        2 => ['class' => ST::class, 'length' => 483, 'opt' => 'O', 'name' => 'Units'],
    ];
}