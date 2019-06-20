<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:07
 */
namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0472;

class TQ extends Field
{
    use parentFieldTrait;
    protected static $name = 'TQ';
    protected static $structure = [
        1 => ['class' => CQ::class, 'length' => 267, 'opt' => 'O', 'name' => 'Quantity'],
        2 => ['class' => RI::class, 'length' => 206, 'opt' => 'O', 'name' => 'Interval'],
        3 => ['class' => ST::class, 'length' => 6, 'opt' => 'O', 'name' => 'Duration'],
        4 => ['class' => TS::class, 'length' => 26, 'opt' => 'O', 'name' => 'Start Date/Time'],
        5 => ['class' => TS::class, 'length' => 26, 'opt' => 'O', 'name' => 'End Date/Time'],
        6 => ['class' => ST::class, 'length' => 6, 'opt' => 'O', 'name' => 'Priority'],
        7 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Condition'],
        8 => ['class' => TX::class, 'length' => 200, 'opt' => 'O', 'name' => 'Text'],
        9 => ['class' => ID::class, 'length' => 1, 'opt' => 'O', 'name' => 'Conjunction', 'table' => Table0472::class],
        10 => ['class' => OSD::class, 'length' => 110, 'opt' => 'O', 'name' => 'Order Sequencing'],
        11 => ['class' => CE::class, 'length' => 483, 'opt' => 'O', 'name' => 'Occurrence Duration'],
        12 => ['class' => NM::class, 'length' => 4, 'opt' => 'O', 'name' => 'Total Occurrences'],

    ];
}