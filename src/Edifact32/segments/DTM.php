<?php


namespace mmerlijn\msg\src\Edifact32\segments;






use mmerlijn\msg\src\Edifact32\fields\C507;

class DTM extends Segment
{
    protected static $name = 'DTM';
    protected static $structure = [
        1 => ['class' => C507::class,  'opt' => 'M', 'name' => 'DATE/TIME/PERIOD'],
    ];
}