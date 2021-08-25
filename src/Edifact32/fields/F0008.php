<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0008 extends Field
{
    protected static $name = '0008';
    protected static $type = "an";
    protected static $length = 14;
    protected static $varLength=true;
}