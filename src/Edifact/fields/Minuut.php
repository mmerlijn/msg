<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Minuut extends Field
{
    protected static $name = 'Minuut';
    protected static $type = "n";
    protected static $length = 2;
    protected static $varLength=false;
    protected static $format="i";
}