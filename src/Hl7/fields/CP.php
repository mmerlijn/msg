<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:28
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0205;
use mmerlijn\msg\src\Hl7\tables\Table0298;


class CP extends Field
{
    use parentFieldTrait;
    protected static $name = 'CP';
    protected static $structure = [
        1 => ['class' => MO::class, 'length' => 20, 'opt' => 'R', 'name' => 'Price'],
        2 => ['class' => ID::class, 'length' => 2, 'opt' => 'O', 'name' => 'Price Type', 'table' => Table0205::class],
        3 => ['class' => NM::class, 'length' => 16, 'opt' => 'O', 'name' => 'From Value'],
        4 => ['class' => NM::class, 'length' => 16, 'opt' => 'O', 'name' => 'To Value'],
        5 => ['class' => CE::class, 'length' => 483, 'opt' => 'O', 'name' => 'Range Units'],
        6 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Range Type', 'table' => Table0298::class],

    ];
}