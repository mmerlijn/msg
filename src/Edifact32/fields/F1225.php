<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F1225 extends Field
{
    protected static $name = '1225';
    protected static $type = "an";
    protected static $length = 1;
    protected static $varLength=false;
    protected static $allowed=['2','7','9'];
    // 2 addition
    // 7 duplicate
    // 9 original (new laboratory service order)
}