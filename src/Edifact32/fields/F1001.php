<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Document/message name, coded
class F1001 extends Field
{
    protected static $name = '1001';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=false;
    protected static $allowed=['LRP'];
    protected static $default="LPR";
}