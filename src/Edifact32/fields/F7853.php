<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F7853 extends Field
{
    protected static $name = '7853';
    protected static $type = "an";
    protected static $length = 2;
    protected static $varLength=true;
    protected static $allowed=['AV','CV','NR','NV','TV'];
// AV Alphanumerical value   CV Coded value   NR Numerical value range   NV Numerical value   TV Text value
}