<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Uur extends Field
{
    protected static $name = 'Uur';
    protected static $type = "n";
    protected static $length = 2;
    protected static $varLength=false;
    protected static $format="H";
}