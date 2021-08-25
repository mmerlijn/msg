<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Party name format, coded
class F3045 extends Field
{
    protected static $name = '3045';
    protected static $type = "an";
    protected static $length = 2;
    protected static $varLength=true;
    protected static $allowed=['NO','NP'];
// NO Naam organisatie
// NP Naam persoon
}