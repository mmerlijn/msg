<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F6167 extends Field
{
    protected static $name = '6167';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['NRM','NWD'];
    //+(“NRM” normaal waarden)+(“NWD” normaalwaarden x 1000
}