<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\fields\C056;
use mmerlijn\msg\src\Edifact32\fields\F3139;

class CTA extends Segment
{
    protected static $name = 'CTA';
    protected static $structure = [


        1 => ['class' => F3139::class,  'opt' => 'C', 'name' => 'CONTACT FUNCTION, CODED'],
        2 => ['class' => C056::class,  'opt' => 'C', 'name' => 'DEPARTMENT OR EMPLOYEE DETAILS'],

    ];
}