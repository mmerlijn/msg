<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Land extends Field
{
    protected static $name = 'Land';
    protected static $type = "a";
    protected static $length = 20;
    protected static $varLength=true;
}