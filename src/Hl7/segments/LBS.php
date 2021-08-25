<?php
/*
This segment is only used for internal communication
*/

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\ST;

class LBS extends Segment
{
    protected static $name = 'LBS';
    protected static $structure = [
        1 => ['class' => ST::class, 'rpt' => false, 'length' => 10, 'opt' => 'R', 'name' => 'GOED or ERROR'], //
        2 => ['class' => NM::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'response code 1=oke, 2 response error, 3=?'], //
        3 => ['class' => ST::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => '???'], //
        4 => ['class' => ST::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Error message'], //
        5 => ['class' => ST::class, 'rpt' => false, 'length' => 250, 'opt' => 'R', 'name' => '???'], //
        6 => ['class' => ST::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => '???'], //
        7 => ['class' => ST::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => '???'], //

    ];

    public function getStructure()
    {
        return static::$structure;
    }

}