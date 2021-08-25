<?php


namespace mmerlijn\msg\src\Edifact\fields;


class SoortBepaling extends Field
{
    protected static $name = 'SoortBepaling';
    protected static $type = "n";
    protected static $length = 1;
    protected static $varLength=false;
}