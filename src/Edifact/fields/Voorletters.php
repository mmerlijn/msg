<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Voorletters extends Field
{
    protected static $name = 'Voorletters';
    protected static $type = "a";
    protected static $length = 8;
    protected static $varLength=true;
}