<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Jaar extends Field
{
    protected static $name = 'Jaar';
    protected static $type = "n";
    protected static $length = 2;
    protected static $varLength=false;
    protected static $format="y";
}