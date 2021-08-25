<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F9011 extends Field
{
    protected static $name = '9011';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['G','P','S','GU'];

    // G Compleet   P Partial   S Supplementary   GU Gewijzigde uitslag
}