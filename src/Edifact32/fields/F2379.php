<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F2379 extends Field
{
    protected static $name = '2379';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength = false;
    protected static $allowed = ['102', '201','203'];
    //102 CCYYMMDD
    //201 YYMMDDHHMM
    //203 CYYMMDDHHMM
}
