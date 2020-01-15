<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C076;


class COM extends Segment
{
    protected static $name = 'COM';
    protected static $structure = [


        1 => ['class' => C076::class,  'opt' => 'M', 'name' => 'COMMUNICATION CONTACT'],

    ];
}