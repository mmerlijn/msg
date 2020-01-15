<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0073 extends Field
{
    protected static $name = '0073';
    protected static $type = "a";
    protected static $length = 1;
    protected static $varLength=false;
    protected static $allowed=["C","F"]; //C = Creation, F = Final
}