<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Voorvoegsels extends Field
{
    protected static $name = 'Voorvoegsels';
    protected static $type = "a";
    protected static $length = 8;
    protected static $varLength=true;
}