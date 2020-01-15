<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Reference qualifier
class F1153 extends Field
{
    protected static $name = '1153';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=false;
    protected static $allowed=['AGO','ASL','LHB','LSB','LZB','ROI','RTI','RTS','SRI','STI'];

}