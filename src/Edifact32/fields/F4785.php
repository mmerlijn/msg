<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Priority qualifier
class F4785 extends Field
{
    protected static $name = '4785';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['REP'];
    //REP Reporting priority
}