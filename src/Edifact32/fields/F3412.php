<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F3412 extends Field
{
    protected static $name = '3412';
    protected static $type = "an";
    protected static $length = 35;
    protected static $varLength=true;
}