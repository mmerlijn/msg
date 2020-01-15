<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0052 extends Field
{
    protected static $name = '0052';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
}