<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Postcode identification
class F3251 extends Field
{
    protected static $name = '3251';
    protected static $type = "an";
    protected static $length = 6;
    protected static $varLength=false;
}