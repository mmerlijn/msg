<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Titels extends Field
{
    protected static $name = 'Titels';
    protected static $type = "a";
    protected static $length = 10;
    protected static $varLength=true;
}