<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:16
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0291;
use mmerlijn\msg\src\Hl7\tables\Table0191;

class RP extends Field
{
    use parentFieldTrait;
    protected static $name = 'RP';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 15, 'opt' => 'O', 'name' => 'Pointer'],
        2 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Application Id'],
        3 => ['class' => ID::class, 'length' => 9, 'opt' => 'O', 'name' => 'Type Of Data', 'table' => Table0191::class],
        4 => ['class' => ID::class, 'length' => 19, 'opt' => 'O', 'name' => 'Subtype', 'table' => Table0291::class],
    ];
}