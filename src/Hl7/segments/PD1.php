<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 10:29
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\IS;
use mmerlijn\msg\src\Hl7\tables\Table0220;
use mmerlijn\msg\src\Hl7\tables\Table0223;

class PD1 extends Segment
{
    protected static $name="PD1";
    protected static $structure = [
        1 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Living Dependency','table'=>Table0223::class],
        2 => ['class' => IS::class, 'rpt' => false, 'length' => 2, 'opt' => 'O', 'name' => 'Living Arrangement','table'=>Table0220::class],
        //..continue
    ];
}