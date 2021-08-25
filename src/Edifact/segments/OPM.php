<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\F0078;

class OPM extends Segment
{
    protected static $name = 'OPM';
    protected static $structure = [
        1 => ['class' => F0078::class,  'opt' => 'M', 'name' => 'Opmerking materiaal/aanvraag'],

    ];
}