<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0004 extends Field
{
    protected static $name = '0004';
    protected static $type = "an";
    protected static $length = 35;
    protected static $varLength=true;

}