<?php


namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\tables\Table0398;

class DSC extends Segment
{
    protected static $name = 'DSC';
    protected static $structure = [
        1 => ['class' => ST::class, 'rpt' => false, 'length' => 180, 'opt' => 'R', 'name' => 'Continuation Pointer'],
        2 => ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'R', 'table'=>Table0398::class, 'name' => 'Continuation Style'],
        ];
}