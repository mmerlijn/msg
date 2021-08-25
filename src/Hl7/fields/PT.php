<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 11:41
 */

namespace mmerlijn\msg\src\Hl7\fields;


class PT extends Field
{
    use parentFieldTrait;
    protected static $name = 'PT';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 999, 'opt' => 'O', 'name' => 'Processing ID'],
        2 => ['class' => ST::class, 'length' => 999, 'opt' => 'O', 'name' => 'Processing Mode'],
    ];
}