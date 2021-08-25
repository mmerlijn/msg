<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F3843 extends Field
{
    protected static $name = '3843';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;

    // 1 Street name in AC1, street address number in AC2
    //  2 P.O.Box-number in AC1 and AC2
    //3 Antwoordnummer in AC1 en AC2
}