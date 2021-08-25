<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:08
 */

namespace mmerlijn\msg\src\Hl7\fields;


class PRL extends Field
{
    use parentFieldTrait;
    protected static $name = 'PRL';
    protected static $structure = [
        1 => ['class' => CE::class, 'length' => 483, 'opt' => 'R', 'name' => 'Parent Observation Identifier'],
        2 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Parent Observation Sub-identifier'],
        3 => ['class' => TX::class, 'length' => 250, 'opt' => 'O', 'name' => 'Parent Observation Value Descriptor'],


    ];
}