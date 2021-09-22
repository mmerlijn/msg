<?php


namespace mmerlijn\msg\src\Hl7\segments;

use mmerlijn\msg\src\Hl7\fields\HD;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\XCN;

class EVN extends Segment
{
    protected static $name = 'EVN';
    protected static $structure = [
        1 => ['class' =>ID::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => 'Event Type Code'],
        2 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'R', 'name' => 'Recorded Date/Time'],
        3 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Date/Time Planned Event'],
        4 => ['class' => IS::class, 'rpt' => false, 'length' => 3, 'opt' => 'O', 'name' => 'Event Reason Code'],
        5 => ['class' => XCN::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Operator ID'],
        6 => ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Event Occurred'],
        7 => ['class' => HD::class, 'rpt' => false, 'length' => 241, 'opt' => 'O', 'name' => 'Event Facility'],
    ];
}