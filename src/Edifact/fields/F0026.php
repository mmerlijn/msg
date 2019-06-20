<?php


namespace mmerlijn\msg\src\Edifact\fields;


class F0026 extends Field
{
    protected static $name = '0026';
    protected static $type = "an";
    protected static $length = 14;
    protected static $varLength=true;
}