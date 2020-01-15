<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0010 extends Field
{
    protected static $name = '0010';
    protected static $type = "an";
    protected static $length = 35;
    protected static $varLength=true;
}