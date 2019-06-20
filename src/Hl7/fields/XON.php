<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 16:42
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0061;
use mmerlijn\msg\src\Hl7\tables\Table0203;
use mmerlijn\msg\src\Hl7\tables\Table0204;
use mmerlijn\msg\src\Hl7\tables\Table0363;
use mmerlijn\msg\src\Hl7\tables\Table0465;

class XON extends Field
{
    use parentFieldTrait;
    protected static $name = 'XON';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Organization Name'],
        2 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Organization Name Type Code', 'table' => Table0204::class],
        3 => ['class' => NM::class, 'length' => 4, 'opt' => 'B', 'name' => 'Id Number'],
        4 => ['class' => NM::class, 'length' => 1, 'opt' => 'O', 'name' => 'Check Digit'],
        5 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'name' => 'Check Digit Scheme', 'table' => Table0061::class],
        6 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Assigning Authority', 'table' => Table0363::class],
        7 => ['class' => ID::class, 'length' => 5, 'opt' => 'O', 'name' => 'Identifier Type Code', 'table' => Table0203::class],
        8 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Assigning Facility'],
        9 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Name Representation Code', 'table' => Table0465::class],
        10 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Organization Identifier'],


    ];
}