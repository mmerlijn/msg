<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 10:21
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\HD;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\XPN;
use mmerlijn\msg\src\Hl7\fields\XAD;
use mmerlijn\msg\src\Hl7\fields\XTN;
use mmerlijn\msg\src\Hl7\fields\DLN;
use mmerlijn\msg\src\Hl7\tables\Table0001;
use mmerlijn\msg\src\Hl7\tables\Table0002;
use mmerlijn\msg\src\Hl7\tables\Table0005;
use mmerlijn\msg\src\Hl7\tables\Table0006;
use mmerlijn\msg\src\Hl7\tables\Table0136;
use mmerlijn\msg\src\Hl7\tables\Table0171;
use mmerlijn\msg\src\Hl7\tables\Table0172;
use mmerlijn\msg\src\Hl7\tables\Table0189;
use mmerlijn\msg\src\Hl7\tables\Table0212;
use mmerlijn\msg\src\Hl7\tables\Table0289;
use mmerlijn\msg\src\Hl7\tables\Table0296;
use mmerlijn\msg\src\Hl7\tables\Table0429;
use mmerlijn\msg\src\Hl7\tables\Table0445;
use mmerlijn\msg\src\Hl7\tables\Table0446;
use mmerlijn\msg\src\Hl7\tables\Table0447;
use mmerlijn\msg\src\Hl7\tools\EncodingChars;

class PID extends Segment
{
    protected static $name = 'PID';
    protected static $structure = [
        1 => ['class' => SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Set ID - PID'], //
        2 => ['class' => CX::class, 'rpt' => false, 'length' => 20, 'opt' => 'B', 'name' => 'Patient ID'], //
        3 => ['class' => CX::class, 'rpt' => true, 'length' => 250, 'opt' => 'R', 'name' => 'Patient Identifier List'], //
        4 => ['class' => CX::class, 'rpt' => true, 'length' => 20, 'opt' => 'B', 'name' => 'Alternate Patient ID - PID'], //
        5 => ['class' => XPN::class, 'rpt' => true, 'length' => 250, 'opt' => 'R', 'name' => 'Patient Name'], //
        6 => ['class' => XPN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Mother\'s Maiden Name'], //
        7 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Date/Time Of Birth'], //
        8 => ['class' => IS::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'table' => Table0001::class, 'name' => 'Administrative Sex'], //
        9 => ['class' => XPN::class, 'rpt' => true, 'length' => 250, 'opt' => 'B', 'name' => 'Patient Alias'], //
        10 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'table' => Table0005::class, 'name' => 'Race'], //
        11 => ['class' => XAD::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Patient Address'], //
        12 => ['class' => IS::class, 'rpt' => false, 'length' => 4, 'opt' => 'B', Table0289::class, 'name' => 'County Code'], //
        13 => ['class' => XTN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Phone Number - Home'], //
        14 => ['class' => XTN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Phone Number - Business'], //
        15 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'table' => Table0296::class, 'name' => 'Primary Language'], //
        16 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'table' => Table0002::class, 'name' => 'Marital Status'], //
        17 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'table' => Table0006::class, 'name' => 'Religion'], //
        18 => ['class' => CX::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Patient Account Number'], //
        19 => ['class' => ST::class, 'rpt' => false, 'length' => 16, 'opt' => 'B', 'name' => 'SSN Number - Patient'], //
        20 => ['class' => DLN::class, 'rpt' => false, 'length' => 25, 'opt' => 'O', 'name' => 'Driver\'s License Number - Patient'], //
        21 => ['class' => CX::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Mother\'s Identifier'], //
        22 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'table' => Table0189::class, 'name' => 'Ethnic Group'], //
        23 => ['class' => ST::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Birth Place'], //
        24 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'table' => Table0136::class, 'name' => 'Multiple Birth Indicator'], //
        25 => ['class' => NM::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Birth Order'], //
        26 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'table' => Table0171::class, 'name' => 'Citizenship'], //
        27 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'table' => Table0172::class, 'name' => 'Veterans Military Status'], //
        28 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'table' => Table0212::class, 'name' => 'Nationality'], //
        29 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Patient Death Date and Time'], //
        30 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'table' => Table0136::class, 'name' => 'Patient Death Indicator'], //
        31 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'table' => Table0136::class, 'name' => 'Identity Unknown Indicator'], //
        32 => ['class' => IS::class, 'rpt' => true, 'length' => 20, 'opt' => 'O', 'table' => Table0445::class, 'name' => 'Identity Reliability Code'], //
        33 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Last Update Date/Time'], //
        34 => ['class' => HD::class, 'rpt' => false, 'length' => 40, 'opt' => 'O', 'name' => 'Last Update Facility'], //
        35 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'C', 'table' => Table0446::class, 'name' => 'Species Code'], //
        36 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'C', 'table' => Table0447::class, 'name' => 'Breed Code'], //
        37 => ['class' => ST::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Strain'], //
        38 => ['class' => CE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'table' => Table0429::class, 'name' => 'Production Class Code'], //

    ];

    public function getStructure()
    {
        return static::$structure;
    }

}