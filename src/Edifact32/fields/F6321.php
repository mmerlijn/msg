<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F6321 extends Field
{
    protected static $name = '6321';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
}