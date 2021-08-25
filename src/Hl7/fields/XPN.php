<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 11:57
 */
namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0200;
use mmerlijn\msg\src\Hl7\tables\Table0360;
use mmerlijn\msg\src\Hl7\tables\Table0444;
use mmerlijn\msg\src\Hl7\tables\Table0448;
use mmerlijn\msg\src\Hl7\tables\Table0465;

class XPN extends Field
{
    use parentFieldTrait;
    protected static $name = 'XPN';
    private static $structure = [
        1 => ['class' => FNF::class, 'length' => 194, 'opt' => 'O', 'name' => 'Family Name'],
        2 => ['class' => ST::class, 'length' => 30, 'opt' => 'O', 'name' => 'Given Name'],
        3 => ['class' => ST::class, 'length' => 30, 'opt' => 'O', 'name' => 'Second And Further Given Names Or Initials Thereof'],
        4 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Suffix (e.g., Jr Or Iii)'],
        5 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Prefix (e.g., Dr)'],
        6 => ['class' => IS::class, 'length' => 6, 'opt' => 'B', 'name' => 'Degree (e.g., Md)', 'table' => Table0360::class],
        7 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Name Type Code', 'table' => Table0200::class],
        8 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Name Representation Code', 'table' => Table0465::class],
        9 => ['class' => CE::class, 'length' => 483, 'opt' => 'O', 'name' => 'Name Context', 'table' => Table0448::class],
        10 => ['class' => DR::class, 'length' => 53, 'opt' => 'B', 'name' => 'Name Validity Range'],
        11 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Name Assembly Order', 'table' => Table0444::class],

    ];
}