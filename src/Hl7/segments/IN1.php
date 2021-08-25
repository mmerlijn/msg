<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 21:20
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\AUI;
use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\CP;
use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\Hl7\fields\DT;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XAD;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\fields\XON;
use mmerlijn\msg\src\Hl7\fields\XPN;
use mmerlijn\msg\src\Hl7\fields\XTN;
use mmerlijn\msg\src\Hl7\tables\Table0001;
use mmerlijn\msg\src\Hl7\tables\Table0063;
use mmerlijn\msg\src\Hl7\tables\Table0066;
use mmerlijn\msg\src\Hl7\tables\Table0093;
use mmerlijn\msg\src\Hl7\tables\Table0135;
use mmerlijn\msg\src\Hl7\tables\Table0136;
use mmerlijn\msg\src\Hl7\tables\Table0173;
use mmerlijn\msg\src\Hl7\tables\Table0309;
use mmerlijn\msg\src\Hl7\tables\Table0535;

class IN1 extends Segment
{
    protected static $name = 'IN1';
    protected static $structure = [
        1 => ['class' => SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'R', 'name' => 'Set ID - IN1'],
        2 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'R', 'name' => 'Insurance Plan ID'],
        3 => ['class' => CX::class, 'rpt' => true, 'length' => 250, 'opt' => 'R', 'name' => 'Insurance Company ID'],
        4 => ['class' => XON::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insurance Company Name'],
        5 => ['class' => XAD::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insurance Company Address'],
        6 => ['class' => XPN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insurance Co Contact Person'],
        7 => ['class' => XTN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insurance Co Phone Number'],
        8 => ['class' => ST::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Group Number'],
        9 => ['class' => XON::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Group Name'],
        10 => ['class' => CX::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insured\'s Group Emp ID'],
        11 => ['class' => XON::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insured\'s Group Emp Name'],
        12 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Plan Effective Date'],
        13 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Plan Expiration Date'],
        14 => ['class' => AUI::class, 'rpt' => false, 'length' => 239, 'opt' => 'O', 'name' => 'Authorization Information'],
        15 => ['class' => IS::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => 'Plan Type'],
        16 => ['class' => XPN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Name Of Insured'],
        17 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Insured\'s Relationship To Patient', 'table' => Table0063::class],
        18 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Insured\'s Date Of Birth'],
        19 => ['class' => XAD::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => '	Insured\'s Address'],
        20 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Assignment Of Benefits', 'table' => Table0135::class],
        21 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Coordination Of Benefits', 'table' => Table0173::class],
        22 => ['class' => ST::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Coord Of Ben. Priority'],
        23 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Notice Of Admission Flag', 'table' => Table0136::class],
        24 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Notice Of Admission Date'],
        25 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Report Of Eligibility Flag', 'table' => Table0136::class],
        26 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Report Of Eligibility Date'],
        27 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Release Information Code', 'table' => Table0093::class],
        28 => ['class' => ST::class, 'rpt' => false, 'length' => 15, 'opt' => 'O', 'name' => 'Pre-Admit Cert'],
        29 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Verification Date/Time'],
        30 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Verification By'],
        31 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Type Of Agreement Code'],
        32 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Billing Status'],
        33 => ['class' => NM::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Lifetime Reserve Days'],
        34 => ['class' => NM::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Delay Before L.R. Day'],
        35 => ['class' => IS::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Company Plan Code'],
        36 => ['class' => ST::class, 'rpt' => false, 'length' => 15, 'opt' => 'O', 'name' => 'Policy Number'],
        37 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Policy Deductible'],
        38 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'B', 'name' => 'Policy Limit - Amount'],
        39 => ['class' => NM::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Policy Limit - Days'],
        40 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'B', 'name' => 'Room Rate - Semi-Private'],
        41 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Room Rate - Private'],
        42 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Insured\'s Employment Status', 'table' => Table0066::class],
        43 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Insured\'s Administrative Sex', 'table' => Table0001::class],
        44 => ['class' => XAD::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insured\'s Employer\'s Address'],
        45 => ['class' => ST::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Verification Status'],
        46 => ['class' => IS::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Prior Insurance Plan ID'],
        47 => ['class' => IS::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => 'Coverage Type', 'table' => Table0309::class],
        48 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Handicap'],
        49 => ['class' => CX::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insured\'s ID Number'],
        50 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Signature Code', 'table' => Table0535::class],
        51 => ['class' => DT::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Signature Code Date'],
        52 => ['class' => ST::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Insured_s Birth Place'],
        53 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'VIP Indicator'],


    ];
}