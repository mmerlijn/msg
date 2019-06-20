<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 21:21
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\Hl7\fields\SI;

class IN3 extends Segment
{
    protected static $name = 'IN3';
    protected static $structure = [
        1 => ['class' => SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'R', 'name' => 'Set ID - IN3'],
        2 => ['class' => CX::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Certification Number'],
        //.. continue
    ];
}