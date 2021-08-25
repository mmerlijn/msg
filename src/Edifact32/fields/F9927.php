<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Investigation characteristic qualifier
class F9927 extends Field
{
    protected static $name = '9927';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['1','2','3','4','5'];
    // 1 Bepaling   2 Deelbepaling   3 Groepsbepaling   4 Cascade-onderzoek   5 Sectienaam
}