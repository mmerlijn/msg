<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 21:20
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\Hl7\fields\ST;

class IN2 extends Segment
{
    protected static $name = 'IN2';
    protected static $structure = [
        1 => ['class' => CX::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Insured\'s Employee ID'],
        2 => ['class' => ST::class, 'rpt' => false, 'length' => 11, 'opt' => 'O', 'name' => 'Insured\'s Social Security Number'],
        //.. continue
    ];
}