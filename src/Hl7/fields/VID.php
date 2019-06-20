<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 12:43
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0104;
use mmerlijn\msg\src\Hl7\tables\Table0399;

class VID extends Field
{
    use parentFieldTrait;
    protected static $name = 'VID';
    private static $structure = [
        1 => ['class' => ID::class, 'length' => 5, 'opt' => 'O', 'name' => 'Version Id', 'table' => Table0104::class],
        2 => ['class' => CE::class, 'length' => 483, 'opt' => 'O', 'name' => 'Internationalization Code', 'table' => Table0399::class],
        3 => ['class' => CE::class, 'length' => 483, 'opt' => 'O', 'name' => 'International Version Id'],


    ];
}