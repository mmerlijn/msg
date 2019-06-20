<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 21:23
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\CQ;
use mmerlijn\msg\src\Hl7\fields\CWE;
use mmerlijn\msg\src\Hl7\fields\EI;
use mmerlijn\msg\src\Hl7\fields\EIP;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\MOC;
use mmerlijn\msg\src\Hl7\fields\NDL;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\PRL;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\fields\SPS;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TQ;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\fields\XTN;
use mmerlijn\msg\src\Hl7\tables\Table0065;
use mmerlijn\msg\src\Hl7\tables\Table0074;
use mmerlijn\msg\src\Hl7\tables\Table0123;
use mmerlijn\msg\src\Hl7\tables\Table0124;
use mmerlijn\msg\src\Hl7\tables\Table0507;

class OBR extends Segment
{
    protected static $name = 'OBR';
    protected static $structure = [
        1 => ['class' => SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Set ID - OBR'],
        2 => ['class' => EI::class, 'rpt' => false, 'length' => 22, 'opt' => 'C', 'name' => 'Placer Order Number'],
        3 => ['class' => EI::class, 'rpt' => false, 'length' => 22, 'opt' => 'C', 'name' => 'Filler Order Number'],
        4 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'R', 'name' => 'Universal Service Identifier'],
        5 => ['class' => ID::class, 'rpt' => false, 'length' => 2, 'opt' => 'B', 'name' => 'Priority _ OBR'],
        6 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'B', 'name' => 'Requested Date/Time'],
        7 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'C', 'name' => 'Observation Date/Time'],
        8 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Observation End Date/Time'],
        9 => ['class' => CQ::class, 'rpt' => false, 'length' => 20, 'opt' => 'O', 'name' => 'Collection Volume'],
        10 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Collector Identifier'],
        11 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Specimen Action Code', 'table' => Table0065::class],
        12 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Danger Code'],
        13 => ['class' => ST::class, 'rpt' => false, 'length' => 300, 'opt' => 'O', 'name' => 'Relevant Clinical Information'],
        14 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'B', 'name' => 'Specimen Received Date/Time'],
        15 => ['class' => SPS::class, 'rpt' => false, 'length' => 300, 'opt' => 'B', 'name' => 'Specimen Source'],
        16 => ['class' => XCN::class, 'rpt' => true, 'length' => 350, 'opt' => 'O', 'name' => 'Ordering Provider'],
        17 => ['class' => XTN::class, 'rpt' => true, 'length' => 350, 'opt' => 'O', 'name' => 'Order Callback Phone Number'],
        18 => ['class' => ST::class, 'rpt' => false, 'length' => 60, 'opt' => 'O', 'name' => 'Placer Field 1'],
        19 => ['class' => ST::class, 'rpt' => false, 'length' => 60, 'opt' => 'O', 'name' => 'Placer Field 2'],
        20 => ['class' => ST::class, 'rpt' => false, 'length' => 60, 'opt' => 'O', 'name' => 'Filler Field 1'],
        21 => ['class' => ST::class, 'rpt' => false, 'length' => 60, 'opt' => 'O', 'name' => 'Filler Field 2'],
        22 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'C', 'name' => 'Results Rpt/Status Chng - Date/Time'],
        23 => ['class' => MOC::class, 'rpt' => false, 'length' => 40, 'opt' => 'O', 'name' => 'Charge to Practice'],
        24 => ['class' => ID::class, 'rpt' => false, 'length' => 10, 'opt' => 'O', 'name' => 'Diagnostic Serv Sect ID', 'table' => Table0074::class], //table0074
        25 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'C', 'name' => 'Result Status', 'table' => Table0123::class],   //table0123
        26 => ['class' => PRL::class, 'rpt' => false, 'length' => 400, 'opt' => 'O', 'name' => 'Parent Result'],
        27 => ['class' => TQ::class, 'rpt' => true, 'length' => 200, 'opt' => 'B', 'name' => 'Quantity/Timing'],
        28 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Result Copies To'],
        29 => ['class' => EIP::class, 'rpt' => false, 'length' => 200, 'opt' => 'O', 'name' => 'Parent Number'],
        30 => ['class' => ID::class, 'rpt' => false, 'length' => 20, 'opt' => 'O', 'name' => 'Transportation Mode', 'table' => Table0124::class], //table0124
        31 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Reason for Study'],
        32 => ['class' => NDL::class, 'rpt' => false, 'length' => 200, 'opt' => 'O', 'name' => 'Principal Result Interpreter'],
        33 => ['class' => NDL::class, 'rpt' => true, 'length' => 200, 'opt' => 'O', 'name' => 'Assistant Result Interpreter'],
        34 => ['class' => NDL::class, 'rpt' => true, 'length' => 200, 'opt' => 'O', 'name' => 'Technician'],
        35 => ['class' => NDL::class, 'rpt' => true, 'length' => 200, 'opt' => 'O', 'name' => 'Transcriptionist'],
        36 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Scheduled Date/Time'],
        37 => ['class' => NM::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Number of Sample Containers *'],
        38 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Transport Logistics of Collected Sample'],
        39 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Collector\'s Comment *'],
        40 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Transport Arrangement Responsibility'],
        41 => ['class' => ID::class, 'rpt' => false, 'length' => 30, 'opt' => 'O', 'name' => 'Transport Arranged'],
        42 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Escort Required'],
        43 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Planned Patient Transport Comment'],
        44 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Procedure Code'],
        45 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => '	Procedure Code Modifier'],
        46 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Placer Supplemental Service Information'],
        47 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Filler Supplemental Service Information'],
        48 => ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'C', 'name' => 'Medically Necessary Duplicate Procedure Reason.'],
        49 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => '	Result Handling', 'table' => Table0507::class],
        50 => ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Parent Universal Service Identifier'],
    ];
}