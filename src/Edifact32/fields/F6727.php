<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Range Type qualifier
class F6727 extends Field
{
    protected static $name = '6727';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['RU'];
    //RU Meervoudige referentiewaarden van de uitslag
}