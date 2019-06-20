<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 21:23
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\CWE;
use mmerlijn\msg\src\Hl7\fields\EI;
use mmerlijn\msg\src\Hl7\fields\EIP;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\PL;
use mmerlijn\msg\src\Hl7\fields\TQ;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XAD;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\fields\XON;
use mmerlijn\msg\src\Hl7\fields\XTN;
use mmerlijn\msg\src\Hl7\tables\Table0038;
use mmerlijn\msg\src\Hl7\tables\Table0119;
use mmerlijn\msg\src\Hl7\tables\Table0121;
use mmerlijn\msg\src\Hl7\tables\Table0177;
use mmerlijn\msg\src\Hl7\tables\Table0339;
use mmerlijn\msg\src\Hl7\tables\Table0482;
use mmerlijn\msg\src\Hl7\tables\Table0483;

class ORC extends Segment
{
    protected static $name = 'ORC';
    protected static $structure = [
        1 => ['class' => ID::class, 'rpt' => false, 'length' => 2, 'opt' => 'R', 'name' => 'Order Control','table'=>Table0119::class],
        2 => ['class' => EI::class, 'rpt' => false, 'length' => 22, 'opt' => 'C', 'name' => 'Placer Order Number'],
        3 => ['class' => EI::class, 'rpt' => false, 'length' => 22, 'opt' => 'C', 'name' => 'Filler Order Number'],
        4 => ['class' => EI::class, 'rpt' => false, 'length' => 22, 'opt' => 'O', 'name' => 'Placer Group Number'],
        5 => ['class' => ID::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Order Status','table'=>Table0038::class],
        6 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Response Flag','table'=>Table0121::class],
        7 => ['class' => TQ::class, 'rpt' => true, 'length' => 200, 'opt' => 'B', 'name' => 'Quantity/Timing'],
        8 => ['class' => EIP::class, 'rpt' => false, 'length' => 200, 'opt' => 'O', 'name' => 'Parent Order'],
        9 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Date/Time of Transaction'],
        10 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Entered By'],
        11 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Verified By'],
        12 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Ordering Provider'],
        13 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Enterer\'s Location'],
         14=> ['class' => XTN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Call Back Phone Number'],
         15=> ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Order Effective Date/Time'],
         16=> ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Order Control Code Reason'],
         17=> ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Entering Organization'],
         18=> ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Entering Device'],
         19=> ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Action By'],
         20=> ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Advanced Beneficiary Notice Code','table'=>Table0339::class],
         21=> ['class' => XON::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Ordering Facility Name'],
         22=> ['class' => XAD::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Ordering Facility Address'],
         23=> ['class' => XTN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Ordering Facility Phone Number'],
         24=> ['class' => XAD::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Ordering Provider Address'],
         25=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Order Status Modifier'],
         26=> ['class' => CWE::class, 'rpt' => false, 'length' => 60, 'opt' => 'C', 'name' => 'Advanced Beneficiary Notice Override Reason'],
         27=> ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Filler\'s Expected Availability Date/Time'],
         28=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Confidentiality Code','table'=>Table0177::class],
         29=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Order Type','table'=>Table0482::class],
         30=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Enterer Authorization Mode','table'=>Table0483::class],
         31=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Parent Universal Service Identifier'],

    ];
}