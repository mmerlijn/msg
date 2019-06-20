<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0051 extends Field
{
    protected static $name = '0051';
    protected static $type = "an";
    protected static $length = 2;
    protected static $varLength=true;
}