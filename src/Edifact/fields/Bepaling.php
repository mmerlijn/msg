<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Bepaling extends Field
{
    protected static $name = 'Bepaling';
    protected static $type = "an";
    protected static $length = 30;
    protected static $varLength=true;
}