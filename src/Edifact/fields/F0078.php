<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0078 extends Field
{
    protected static $name = '0078';
    protected static $type = "an";
    protected static $length = 70;
    protected static $varLength=true;
}