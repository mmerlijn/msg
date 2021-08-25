<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Contact function, coded
class F3139 extends Field
{
    protected static $name = '3139';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=false;
    protected static $allowed=['AFD','PRS'];
// AFD Afdeling
// PRS Persoon
}