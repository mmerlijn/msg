<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Voornaam extends Field
{
    protected static $name = 'Voornaam';
    protected static $type = "a";
    protected static $length = 12;
    protected static $varLength=true;
}