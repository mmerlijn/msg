<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0019 extends Field
{
    protected static $name = '0019';
    protected static $type = "n";
    protected static $length = 4;
    protected static $varLength=false;
    protected static $format = "Hi"; //HHMM
}