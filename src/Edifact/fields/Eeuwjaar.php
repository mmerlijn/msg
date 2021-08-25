<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Eeuwjaar extends Field
{
    protected static $name = 'Eeuwjaar';
    protected static $type = "n";
    protected static $length = 4;
    protected static $varLength=false;
    protected static $format="Y";
}