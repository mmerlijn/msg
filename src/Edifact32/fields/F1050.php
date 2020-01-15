<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F1050 extends Field
{
    protected static $name = '1150';
    protected static $type = "an";
    protected static $length = 6;
    protected static $varLength=true;
}