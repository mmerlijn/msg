<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Measure unit identification
class F6411 extends Field
{
    protected static $name = '3155';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['111','112','117'];
    // 111 Millilitre   112 Litre (1 dm3)   117 Centilitre
}