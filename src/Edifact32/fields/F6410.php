<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F6410 extends Field
{
    protected static $name = '6410';
    protected static $type = "an";
    protected static $length = 35;
    protected static $varLength=true;
}