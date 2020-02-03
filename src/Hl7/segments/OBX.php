<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 21:24
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\EI;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XAD;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\fields\XON;
use mmerlijn\msg\src\Hl7\tables\Table0061;
use mmerlijn\msg\src\Hl7\tables\Table0125;
use mmerlijn\msg\src\Hl7\tables\Table0200;
use mmerlijn\msg\src\Hl7\tables\Table0203;
use mmerlijn\msg\src\Hl7\tables\Table0360;
use mmerlijn\msg\src\Hl7\tables\Table0363;
use mmerlijn\msg\src\Hl7\tables\Table0444;
use mmerlijn\msg\src\Hl7\tables\Table0448;
use mmerlijn\msg\src\Hl7\tables\Table0465;

class OBX extends Segment
{
    protected static $name = 'OBX';
    protected static $structure = [
        1 => ['class' => SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Set ID - OBX'],
        2 => ['class' => ID::class, 'rpt' => false, 'length' => 2, 'opt' => 'C', 'name' => 'Value Type','table'=>Table0125::class],
        3 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'R', 'name' => 'Observation Identifier'],
        4 => ['class' => ST::class, 'rpt' => false, 'length' => 20, 'opt' => 'C', 'name' => 'Observation Sub-ID'],
        5 => ['class' => ST::class, 'rpt' => true, 'length' => 99999, 'opt' => 'C', 'name' => 'Observation Value'],    //type depends on OBX.2
        6 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Units'],
        7 => ['class' => ST::class, 'rpt' => false, 'length' => 60, 'opt' => 'O', 'name' => 'References Range','table'=>Table0360::class],
        8 => ['class' => IS::class, 'rpt' => false, 'length' => 5, 'opt' => 'O', 'name' => 'Abnormal Flags'],
        9 => ['class' => NM::class, 'rpt' => false, 'length' => 5, 'opt' => 'O', 'name' => 'Probability','table'=>Table0363::class],
        10 => ['class' => ID::class, 'rpt' => false, 'length' =>2, 'opt' => 'O', 'name' => 'Nature of Abnormal Test','table'=>Table0200::class],
        11 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'R', 'name' => 'Observation Result Status'],
        12 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Effective Date of Reference Range','table'=>Table0061::class],
        13 => ['class' => ST::class, 'rpt' => false, 'length' => 20, 'opt' => 'O', 'name' => 'User Defined Access Checks','table'=>Table0203::class],
        14 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Date/Time of the Observation'],
        15 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Producer\'s ID','table'=>Table0465::class],
        16 => ['class' => XCN::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Responsible Observer','table'=>Table0448::class],
        17 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Observation Method'],
        18 => ['class' => EI::class, 'rpt' => true, 'length' => 22, 'opt' => 'O', 'name' => 'Equipment Instance Identifier','table'=>Table0444::class],
        19 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Date/Time of the Analysis'],
        20 => ['class' => ST::class, 'rpt' => false, 'length' => 705, 'opt' => 'O', 'name' => 'Observation Site'], //2.6
        21 => ['class' => ST::class, 'rpt' => false, 'length' => 427, 'opt' => 'O', 'name' => 'Observation Instance Identifier'],//2.6
        22 => ['class' => ST::class, 'rpt' => false, 'length' => 705, 'opt' => 'O', 'name' => 'Mood Code'],//2.6
        23 => ['class' => XON::class, 'rpt' => false, 'length' => 567, 'opt' => 'O', 'name' => 'Performing Organization Name'],
        24 => ['class' => XAD::class, 'rpt' => false, 'length' => 631, 'opt' => 'O', 'name' => 'Performing Organization Address'],
        25 => ['class' => XCN::class, 'rpt' => false, 'length' => 3002, 'opt' => 'O', 'name' => 'Performing Organization Medical Director'],
    ];
    protected static function runBeforeSetFilled( $fields)
    {
        if(isset($fields[2])){
            static::$structure[5]['class'] = Table0125::getClass($fields[2]);
        }
    }
    protected static function runBeforeToHl7($segmentWithNr,$dataTree){

        if($segmentWithNr==2){
            static::$structure[5]['class'] = Table0125::getClass($dataTree[0]); //
        }
    }
}