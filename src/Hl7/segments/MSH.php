<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 10:29
 */

namespace mmerlijn\msg\src\Hl7\segments;

use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\EI;
use mmerlijn\msg\src\Hl7\fields\MSG;
use mmerlijn\msg\src\Hl7\fields\HD;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\PT;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\ST_;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\VID;
use mmerlijn\msg\src\Hl7\tables\Table0155;
use mmerlijn\msg\src\Hl7\tables\Table0211;
use mmerlijn\msg\src\Hl7\tables\Table0399;

class MSH extends Segment
{
    protected static $name = 'MSH';
    protected static $structure = [
        1 => ['class' => ST_::class, 'rpt' => false, 'length' => 1, 'opt' => 'R', 'name' => 'Field Separator'], //string field without encoding
        2 => ['class' => ST_::class, 'rpt' => false, 'length' => 4, 'opt' => 'R', 'name' => 'Encoding Characters'], //string field without encoding
        3 => ['class' => HD::class, 'rpt' => false, 'length' => 227, 'opt' => 'O', 'name' => 'Sending Application'], //
        4 => ['class' => HD::class, 'rpt' => false, 'length' => 227, 'opt' => 'O', 'name' => 'Sending Facility'], //
        5 => ['class' => HD::class, 'rpt' => false, 'length' => 227, 'opt' => 'O', 'name' => 'Receiving Application'], //
        6 => ['class' => HD::class, 'rpt' => false, 'length' => 227, 'opt' => 'O', 'name' => 'Receiving Facility'], //
        7 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Date / Time of Message'], //
        8 => ['class' => ST::class, 'rpt' => false, 'length' => 40, 'opt' => 'O', 'name' => 'Security'], //
        9 => ['class' => MSG::class, 'rpt' => false, 'length' => 15, 'opt' => 'R', 'name' => 'Message Type'], //
        10 => ['class' => ST::class, 'rpt' => false, 'length' => 20, 'opt' => 'R', 'name' => 'Message Control ID'], //
        11 => ['class' => PT::class, 'rpt' => false, 'length' => 3, 'opt' => 'R', 'name' => 'Processing ID'], //
        12 => ['class' => VID::class, 'rpt' => false, 'length' => 60, 'opt' => 'R', 'name' => 'Version ID'], //
        13 => ['class' => NM::class, 'rpt' => false, 'length' => 15, 'opt' => 'O', 'name' => '	Sequence Number'], //
        14 => ['class' => ST::class, 'rpt' => false, 'length' => 180, 'opt' => 'O', 'name' => 'Continuation Pointer'], //
        15 => ['class' => ID::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Accept Acknowledgement Type', 'table' => Table0155::class], //
        16 => ['class' => ID::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Application Acknowledgement Type', 'table' => Table0155::class], //
        17 => ['class' => ID::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => 'Country Code', 'table' => Table0399::class], //
        18 => ['class' => ID::class, 'rpt' => true, 'length' => 16, 'opt' => 'O', 'name' => 'Character Set', 'table' => Table0211::class], //
        19 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Principal Language of Message'], //
        20 => ['class' => ID::class, 'rpt' => false, 'length' => 20, 'opt' => 'O', 'name' => 'Alternate Character Set Handling Scheme'], //
        21 => ['class' => EI::class, 'rpt' => true, 'length' => 427, 'opt' => 'O', 'name' => 'Message Profile Identifier'] //
    ];

}