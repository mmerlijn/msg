<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:24
 */
namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0301;
use mmerlijn\msg\src\Hl7\tables\Table0363;
use mmerlijn\msg\src\Hl7\tables\Table0524;

class OSD extends Field
{
    use parentFieldTrait;
    protected static $name = 'OSD';
    protected static $structure = [
        1 => ['class' => ID::class, 'length' => 1, 'opt' => 'R', 'name' => 'Sequence/Results Flag', 'table' => Table0524::class],
        2 => ['class' => ST::class, 'length' => 15, 'opt' => 'R', 'name' => 'Placer Order Number: Entity Identifier'],
        3 => ['class' => IS::class, 'length' => 6, 'opt' => 'O', 'name' => 'Placer Order Number: Namespace Id', 'table' => Table0363::class],
        4 => ['class' => ST::class, 'length' => 15, 'opt' => 'R', 'name' => 'Filler Order Number: Entity Identifier'],
        5 => ['class' => IS::class, 'length' => 6, 'opt' => 'O', 'name' => 'Filler Order Number: Namespace Id', 'table' => Table0363::class],
        6 => ['class' => ST::class, 'length' => 12, 'opt' => 'O', 'name' => 'Sequence Condition Value'],
        7 => ['class' => NM::class, 'length' => 3, 'opt' => 'O', 'name' => 'Maximum Number Of Repeats'],
        8 => ['class' => ST::class, 'length' => 15, 'opt' => 'R', 'name' => 'Placer Order Number: Universal Id'],
        9 => ['class' => ID::class, 'length' => 6, 'opt' => 'O', 'name' => 'Placer Order Number: Universal Id Type', 'table' => Table0301::class],
        10 => ['class' => ST::class, 'length' => 15, 'opt' => 'R', 'name' => 'Filler Order Number: Universal Id'],
        11 => ['class' => ID::class, 'length' => 6, 'opt' => 'O', 'name' => 'Filler Order Number: Universal Id Type', 'table' => Table0301::class],


    ];
}