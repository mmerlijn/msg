<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 21:18
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\Hl7\fields\DLD;
use mmerlijn\msg\src\Hl7\fields\DT;
use mmerlijn\msg\src\Hl7\fields\FC;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\PL;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\tables\Table0004;
use mmerlijn\msg\src\Hl7\tables\Table0007;
use mmerlijn\msg\src\Hl7\tables\Table0009;
use mmerlijn\msg\src\Hl7\tables\Table0023;
use mmerlijn\msg\src\Hl7\tables\Table0069;
use mmerlijn\msg\src\Hl7\tables\Table0092;
use mmerlijn\msg\src\Hl7\tables\Table0112;
use mmerlijn\msg\src\Hl7\tables\Table0116;
use mmerlijn\msg\src\Hl7\tables\Table0203;
use mmerlijn\msg\src\Hl7\tables\Table0326;

class PV1 extends Segment
{
    protected static $name = 'PV1';
    protected static $structure = [
        1 => ['class' => SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Set ID - PV1'],
        2 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'R', 'name' => 'Patient Class','table'=>Table0004::class],
        3 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Assigned Patient Location'],
        4 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Admission Type','table'=>Table0007::class],
        5 => ['class' => CX::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Preadmit Number'],
        6 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Prior Patient Location'],
        7 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Attending Doctor'],
        8 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Referring Doctor'],
        9 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'B', 'name' => 'Consulting Doctor'],
        10 => ['class' => IS::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => 'Hospital Service','table'=>Table0069::class],
        11 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Temporary Location'],
        12 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Preadmit Test Indicator'],
        13 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Re-admission Indicator', 'table'=>Table0092::class],
        14 => ['class' => IS::class, 'rpt' => false, 'length' => 6, 'opt' => 'O', 'name' => 'Admit Source','table'=>Table0023::class],
        15 => ['class' => IS::class, 'rpt' => true, 'length' => 2, 'opt' => 'O', 'name' => 'Ambulatory Status','table'=>Table0009::class],
        16 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'VIP Indicator'],
        17 => ['class' => XCN::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Admitting Doctor'],
        18 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Patient Type'],
        19 => ['class' => CX::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Visit Number'],
        20 => ['class' => FC::class, 'rpt' => true, 'length' => 50, 'opt' => 'O', 'name' => 'Financial Class'],
        21 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Charge Price Indicator'],
        22 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Courtesy Code'],
        23 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Credit Rating'],
        24 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Contract Code'],
        25 => ['class' => DT::class, 'rpt' => true, 'length' => 8, 'opt' => 'O', 'name' => 'Contract Effective Date'],
        26 => ['class' => NM::class, 'rpt' => true, 'length' => 12, 'opt' => 'O', 'name' => 'Contract Amount'],
        27 => ['class' => NM::class, 'rpt' => true, 'length' => 3, 'opt' => 'O', 'name' => 'Contract Period'],
        28 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Interest Code'],
        29 => ['class' => IS::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Transfer to Bad Debt Code'],
        30 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Transfer to Bad Debt Date'],
        31 => ['class' => IS::class, 'rpt' => false, 'length' => 10, 'opt' => 'O', 'name' => 'Bad Debt Agency Code'],
        32 => ['class' => NM::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Bad Debt Transfer Amount'],
        33 => ['class' => NM::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Bad Debt Recovery Amount'],
        34 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Delete Account Indicator'],
        35 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Delete Account Date'],
        36 => ['class' => IS::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => 'Discharge Disposition','table'=>Table0112::class],
        37 => ['class' => DLD::class, 'rpt' => false, 'length' => 47, 'opt' => 'O', 'name' => 'Discharged to Location'],
        38 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Diet Type'],
        39 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Servicing Facility'],
        40 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Bed Status','table'=>Table0116::class],
        41 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Account Status'],
        42 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Pending Location'],
        43 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Prior Temporary Location'],
        44 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Admit Date/Time'],
        45 => ['class' => TS::class, 'rpt' => true, 'length' => 26, 'opt' => 'O', 'name' => 'Discharge Date/Time'],
        46 => ['class' => NM::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Current Patient Balance'],
        47 => ['class' => NM::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Total Charges'],
        48 => ['class' => NM::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Total Adjustments'],
        49 => ['class' => NM::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Total Payments'],
        50 => ['class' => CX::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Alternate Visit ID','table'=>Table0203::class],
        51 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Visit Indicator','table'=>Table0326::class],
        52 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Other Healthcare Provider'],
    ];
}