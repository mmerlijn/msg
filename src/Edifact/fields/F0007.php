<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0007 extends Field
{
    protected static $name = '0007';
    protected static $type = "an";
    protected static $length = 4;
    protected static $varLength=true;
}