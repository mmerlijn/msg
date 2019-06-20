<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0070 extends Field
{
    protected static $name = '0070';
    protected static $type = "n";
    protected static $length = 2;
    protected static $varLength=true;
}