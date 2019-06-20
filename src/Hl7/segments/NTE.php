<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 10:29
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\FT;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\tables\Table0105;
use mmerlijn\msg\src\Hl7\tables\Table0364;

class NTE extends Segment
{
    protected static $name="NTE";
    protected static $structure = [
        1 => ['class' => SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Set ID - NTE'],
        2 => ['class' => ID::class, 'rpt' => false, 'length' => 8, 'opt' => 'O', 'name' => 'Source of Comment','table'=>Table0105::class],
        3 => ['class' => FT::class, 'rpt' => true, 'length' => 65536, 'opt' => 'O', 'name' => 'Comment'],
        4 => ['class' => CE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Comment Type','table'=>Table0364::class],
    ];
}