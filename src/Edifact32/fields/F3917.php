<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Sex, coded
class F3917 extends Field
{
    protected static $name = '3917';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['0','1','2','9'];
    // 0 onbekend   1 mannelijk   2 vrouwelijk   9 niet gespecificeerd
}