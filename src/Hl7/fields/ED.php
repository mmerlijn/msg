<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:23
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0191;
use mmerlijn\msg\src\Hl7\tables\Table0291;
use mmerlijn\msg\src\Hl7\tables\Table0299;

class ED extends Field
{
    use parentFieldTrait;
    protected static $name = 'ED';
    protected static $structure = [
        1 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Source Application'],
        2 => ['class' => ID::class, 'length' => 9, 'opt' => 'R', 'name' => 'Type Of Data', 'table' => Table0191::class],
        3 => ['class' => ID::class, 'length' => 18, 'opt' => 'O', 'name' => 'Data Subtype', 'table' => Table0291::class],
        4 => ['class' => ID::class, 'length' => 6, 'opt' => 'R', 'name' => 'Encoding', 'table' => Table0299::class],
        5 => ['class' => TX::class, 'length' => 65536, 'opt' => 'R', 'name' => 'Data'],


    ];
}