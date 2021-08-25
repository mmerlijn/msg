<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Investigation characteristic identification (aanbevolen wordt om gebruik te maken van Tabel Codering Laboratoriumbepalingen/ WCIA Labcodeplatform)
class F9931 extends Field
{
    protected static $name = '9931';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;

}