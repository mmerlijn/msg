<?php


namespace mmerlijn\msg\src\Edifact32\fields;



class F0017 extends Field
{
    protected static $name = '0017';
    protected static $type = "n";
    protected static $length = 6;
    protected static $varLength=false;
    protected static $format="ymd"; //YYMMDD

}