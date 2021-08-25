<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Quantity qualifier
class F6063 extends Field
{
    protected static $name = '6063';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['CVO'];
    //SVO Volume of sample
}