<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 10:25
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0061;
use mmerlijn\msg\src\Hl7\tables\Table0203;
use mmerlijn\msg\src\Hl7\tables\Table0363;


class CX extends Field
{
    use parentFieldTrait;
    protected static $name = 'CX';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 15, 'opt' => 'O', 'name' => 'Id Number'],
        2 => ['class' => ST::class, 'length' => 1, 'opt' => 'O', 'name' => 'Check Digit'],
        3 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'table' => Table0061::class, 'name' => 'Check Digit Scheme'],
        4 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'table' => Table0363::class, 'name' => 'Assigning Authority'],
        5 => ['class' => ID::class, 'length' => 5, 'opt' => 'O', 'table' => Table0203::class, 'name' => 'Identifier Type Code'],
        6 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Assigning Facility'],
        7 => ['class' => DT::class, 'length' => 8, 'opt' => 'O', 'name' => 'Effective Date'],
        8 => ['class' => DT::class, 'length' => 8, 'opt' => 'O', 'name' => 'Expiration Date'],
    ];

}