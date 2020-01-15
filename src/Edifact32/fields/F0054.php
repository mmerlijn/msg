<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0054 extends Field
{
    protected static $name = '0054';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
}