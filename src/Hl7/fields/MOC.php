<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:05
 */

namespace mmerlijn\msg\src\Hl7\fields;


class MOC extends Field
{
    use parentFieldTrait;
    protected static $name = 'MOC';
    protected static $structure = [
        1 => ['class' => MO::class, 'length' => 20, 'opt' => 'O', 'name' => 'Monetary Amount'],
        2 => ['class' => CE::class, 'length' => 483, 'opt' => 'O', 'name' => 'Charge Code'],


    ];
}