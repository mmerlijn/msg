<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0020 extends Field
{
    protected static $name = '0020';
    protected static $type = "an";
    protected static $length = 14;
    protected static $varLength=true;
}