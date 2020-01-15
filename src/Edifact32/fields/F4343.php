<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Response type, coded
class F4343 extends Field
{
    protected static $name = '4343';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['AB','ERR','NA'];
    //AB Message acknowledgement   ERR Only needed if received in error   NA No acknowledgement needed
}