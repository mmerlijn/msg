<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0065 extends Field
{
    protected static $name = '0065';
    protected static $type = "an";
    protected static $length = 6;
    protected static $varLength=true;
}