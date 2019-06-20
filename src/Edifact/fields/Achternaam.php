<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Achternaam extends Field
{
    protected static $name = 'Achternaam';
    protected static $type = "a";
    protected static $length = 30;
    protected static $varLength=true;
}