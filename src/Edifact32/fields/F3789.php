<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Address status, coded
class F3789 extends Field
{
    protected static $name = '3789';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['PE','TE'];
    // PE Permanent address   TE Temporary address
}