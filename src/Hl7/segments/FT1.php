<?php


namespace mmerlijn\msg\src\Hl7\segments;

use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\CNE;
use mmerlijn\msg\src\Hl7\fields\CP;
use mmerlijn\msg\src\Hl7\fields\CWE;
use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\Hl7\fields\DR;
use mmerlijn\msg\src\Hl7\fields\EI;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\PL;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\tables\Table0017;
use mmerlijn\msg\src\Hl7\tables\Table0339;

class FT1 extends Segment
{
    protected static $name = 'FT1';
    protected static $structure = [
        1 => ['class' =>SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Set ID - FT1'],
        2 => ['class' => ST::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Transaction ID'],
        3 => ['class' => ST::class, 'rpt' => false, 'length' => 10, 'opt' => 'O', 'name' => 'Transaction Batch ID'],
        4 => ['class' => DR::class, 'rpt' => false, 'length' => 53, 'opt' => 'R', 'name' => 'Transaction Date'],
        5 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Transaction Posting Date'],
        6 => ['class' => IS::class, 'rpt' => false, 'length' => 8, 'opt' => 'R', 'name' => 'Transaction Type','table'=>Table0017::class],
        7 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'R', 'name' => 'Transaction Code'],
        8 => ['class' => ST::class, 'rpt' => false, 'length' => 40, 'opt' => 'O', 'name' => 'Transaction Description'],
        9 => ['class' => ST::class, 'rpt' => false, 'length' => 40, 'opt' => 'O', 'name' => 'Transaction Description - Alt'],
        10 => ['class' => NM::class, 'rpt' => false, 'length' => 6, 'opt' => 'O', 'name' => 'Transaction Quantity'],
        11 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Transaction Amount - Extended'],
        12 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Transaction Amount - Unit'],
        13 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Department Code'],
        14 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Insurance Plan ID'],
        15 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Insurance Amount'],
        16 => ['class' => PL::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Assigned Patient Location'],
        17 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Fee Schedule'],
        18 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Patient Type'],
        19 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Diagnosis Code - FT1'],
        20 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Performed By Code'],
        21 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Ordered By Code'],
        22 => ['class' => CP::class, 'rpt' => false, 'length' => 12, 'opt' => 'O', 'name' => 'Unit Cost'],
        23=> ['class' => EI::class, 'rpt' => false, 'length' => 427, 'opt' => 'O', 'name' => 'Filler Order Number'],
        24 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Entered By Code'],
        25 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Procedure Code'],
        26 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Procedure Code Modifier'],
        27 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Advanced Beneficiary Notice Code','table'=>Table0339::class],
        28 => ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Medically Necessary Duplicate Procedure Reason.'],
        29 => ['class' => CNE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'NDC Code'],
        30 => ['class' => CX::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Payment Reference ID'],
        31 => ['class' => SI::class, 'rpt' => true, 'length' => 4, 'opt' => 'O', 'name' => 'Transaction Reference Key'],

    ];
}