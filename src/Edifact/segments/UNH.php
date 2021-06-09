<?php
//message header

namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0062;
use mmerlijn\msg\src\Edifact\fields\F0068;
use mmerlijn\msg\src\Edifact\fields\S009;
use mmerlijn\msg\src\Edifact\fields\S010;

class UNH extends Segment
{
    protected static $name = 'UNH';
    protected static $structure = [
        1 => ['class' => F0062::class,  'opt' => 'M', 'name' => 'MESSAGE REFERENCE NUMBER'],
        2 => ['class' => S009::class,  'opt' => 'M', 'name' => 'MESSAGE IDENTIFIER'],
        3 => ['class' => F0068::class,  'opt' => 'C', 'name' => 'COMMON ACCESS REFERENCE'],
        4 => ['class' => S010::class,  'opt' => 'C', 'name' => 'STATUS OF THE TRANSFER'],


    ];
}