<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0068 extends Field
{
    protected static $name = '0068';
    protected static $type = "an";
    protected static $length = 35;
    protected static $varLength=true;
}