<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F9939 extends Field
{
    protected static $name = '9939';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['FO'];
}