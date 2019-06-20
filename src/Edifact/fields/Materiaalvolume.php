<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Materiaalvolume extends Field
{
    protected static $name = 'Materiaalvolume';
    protected static $type = "an";
    protected static $length = 8;
    protected static $varLength=true;
}