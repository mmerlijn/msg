<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Investigation characteristic (aanbevolen wordt om gebruik te maken van lange/korte omschrijving van bepaling volgens Tabel Codering Laboratoriumbepalingen/WCIALabcodeplatform)
class F9930 extends Field
{
    protected static $name = '9930';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
}