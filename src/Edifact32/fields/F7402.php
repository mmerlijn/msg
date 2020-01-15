<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F7402 extends Field
{
    protected static $name = '7402';
    protected static $type = "an";
    protected static $length = 35;
    protected static $varLength=true;
}