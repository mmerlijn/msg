<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 00:42
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\DT;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\PL;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\tables\Table0130;
use mmerlijn\msg\src\Hl7\tables\Table0136;
use mmerlijn\msg\src\Hl7\tables\Table0213;
use mmerlijn\msg\src\Hl7\tables\Table0214;

class PV2 extends Segment
{
    protected static $name = 'PV2';
    protected static $structure = [
        1 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'C', 'name' => 'Prior Pending Location'],
        2 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Accommodation Code'],
        3 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => ''],
        4 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => ''],
        5 => ['class' => ST::class, 'rpt' => true, 'length' => 25, 'opt' => 'O', 'name' => ''],
        6 => ['class' => ST::class, 'rpt' => false, 'length' => 25, 'opt' => 'O', 'name' => ''],
        7 => ['class' => IS::class, 'rpt' => true, 'length' => 2, 'opt' => 'O', 'name' => '','table'=>Table0130::class],
        8 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => ''],
        9 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => ''],
        10 => ['class' => NM::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => ''],
        11 => ['class' => NM::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => ''],
        12 => ['class' => ST::class, 'rpt' => false, 'length' => 50, 'opt' => 'O', 'name' => ''],
        13 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => ''],
        14 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => ''],
        15 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => '','table'=>Table0136::class],
        16 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => '','table'=>Table0213::class],
        17 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => ''],
        18 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => '','table'=>Table0214::class],
        19 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => '','table'=>Table0136::class],
        20 => ['class' => NM::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => ''],
        /* TODO
        21 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        22 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        23 => ['class' => ::class, 'rpt' => true, 'length' => , 'opt' => 'O', 'name' => ''],
        24 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        25 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        26 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        27 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        28 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        29 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        30 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        31 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        32 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        33 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        34 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        35 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        36 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        37 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        38 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        39 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        40 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        41 => ['class' => ::class, 'rpt' => true, 'length' => , 'opt' => 'O', 'name' => ''],
        42 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        43 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        44 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        45 => ['class' => ::class, 'rpt' => true, 'length' => , 'opt' => 'O', 'name' => ''],
        46 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        47 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        48 => ['class' => ::class, 'rpt' => false, 'length' => , 'opt' => 'O', 'name' => ''],
        49 => ['class' => ::class, 'rpt' => true, 'length' => , 'opt' => 'O', 'name' => ''],
        */

    ];
}