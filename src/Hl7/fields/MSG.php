<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 11:39
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0003;
use mmerlijn\msg\src\Hl7\tables\Table0076;
use mmerlijn\msg\src\Hl7\tables\Table0354;

class MSG extends Field
{
    use parentFieldTrait;
    protected static $name = 'MSG';
    private static $structure = [
        1 => ['class' => ID::class, 'length' => 3, 'opt' => 'R', 'name' => 'Message Type', 'table' => Table0076::class],
        2 => ['class' => ID::class, 'length' => 3, 'opt' => 'R', 'name' => 'Trigger Event', 'table' => Table0003::class],
        3 => ['class' => ID::class, 'length' => 7, 'opt' => 'O', 'name' => 'Message Structure', 'table' => Table0354::class],


    ];
}