<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Country, coded
class F3207 extends Field
{
    protected static $name = '3107';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
}