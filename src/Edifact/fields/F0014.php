<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0014 extends Field
{
    protected static $name = '0014';
    protected static $type = "an";
    protected static $length = 14;
    protected static $varLength=true;
}