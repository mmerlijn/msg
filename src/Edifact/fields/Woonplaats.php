<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Woonplaats extends Field
{
    protected static $name = 'Woonplaats';
    protected static $type = "a";
    protected static $length = 20;
    protected static $varLength=true;
}