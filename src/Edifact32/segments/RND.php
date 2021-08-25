<?php


namespace mmerlijn\msg\src\Edifact32\segments;



use mmerlijn\msg\src\Edifact32\fields\C848;
use mmerlijn\msg\src\Edifact32\fields\F6152;
use mmerlijn\msg\src\Edifact32\fields\F6162;
use mmerlijn\msg\src\Edifact32\fields\F6167;
use mmerlijn\msg\src\Edifact32\fields\F7857;

class RND extends Segment
{
    protected static $name = 'RND';
    protected static $structure = [
        1 => ['class' => F6167::class,  'opt' => 'M', 'name' => 'RANGE TYPE QUALIFIER'],
        2 => ['class' => F6162::class,  'opt' => 'M', 'name' => 'RANGE MINIMUM'],
        3 => ['class' => F6152::class,  'opt' => 'M', 'name' => 'RANGE MAXIMUM'],
        4 => ['class' => C848::class,  'opt' => 'C', 'name' => 'MEASUREMENT UNIT DETAILS'],
        5 => ['class' => F7857::class,  'opt' => 'C', 'name' => 'RESPONSE TYPE CODE'],


    ];
}