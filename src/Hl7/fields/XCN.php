<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 16:26
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0061;
use mmerlijn\msg\src\Hl7\tables\Table0200;
use mmerlijn\msg\src\Hl7\tables\Table0203;
use mmerlijn\msg\src\Hl7\tables\Table0360;
use mmerlijn\msg\src\Hl7\tables\Table0363;
use mmerlijn\msg\src\Hl7\tables\Table0444;
use mmerlijn\msg\src\Hl7\tables\Table0448;
use mmerlijn\msg\src\Hl7\tables\Table0465;

class XCN extends Field
{
    use parentFieldTrait;

    protected static $name = 'XCN';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 15, 'opt' => 'O', 'name' => 'Id Number'],
        2 => ['class' => FNF::class, 'length' => 194, 'opt' => 'O', 'name' => 'Family Name'],
        3 => ['class' => ST::class, 'length' => 30, 'opt' => 'O', 'name' => 'Given Name'],
        4 => ['class' => ST::class, 'length' => 30, 'opt' => 'O', 'name' => 'Second And Further Given Names Or Initials Thereof'],
        5 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Suffix (e.g., Jr Or Iii)'],
        6 => ['class' => ST::class, 'length' => 20, 'opt' => '', 'name' => 'Prefix (e.g., Dr)'],
        7 => ['class' => IS::class, 'length' => 5, 'opt' => 'B', 'name' => 'Degree (e.g., Md)', 'table' => Table0360::class],
        8 => ['class' => IS::class, 'length' => 4, 'opt' => 'C', 'name' => 'Source Table'],
        9 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Assigning Authority', 'table' => Table0363::class],
        10 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Name Type Code', 'table' => Table0200::class],
        11 => ['class' => ST::class, 'length' => 4, 'opt' => 'O', 'name' => 'Identifier Check Digit'],
        12 => ['class' => ID::class, 'length' => 3, 'opt' => 'C', 'name' => 'Check Digit Scheme', 'table' => Table0061::class],
        13 => ['class' => ID::class, 'length' => 5, 'opt' => 'O', 'name' => 'Identifier Type Code', 'table' => Table0203::class],
        14 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Assigning Facility'],
        15 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Name Representation Code', 'table' => Table0465::class],
        16 => ['class' => CE::class, 'length' => 483, 'opt' => 'O', 'name' => 'Name Context', 'table' => Table0448::class],
        17 => ['class' => DR::class, 'length' => 53, 'opt' => 'B', 'name' => 'Name Validity Range'],
        18 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Name Assembly Order', 'table' => Table0444::class],
        19 => ['class' => TS::class, 'length' => 26, 'opt' => 'O', 'name' => 'Effective Date'],
        20 => ['class' => TS::class, 'length' => 26, 'opt' => 'O', 'name' => 'Expiration Date'],
        21 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Professional Suffix'],
        22 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Assigning Jurisdiction'],
        23 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Assigning Agency Or Department'],

    ];
}