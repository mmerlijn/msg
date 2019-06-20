<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Bepalingseenheid extends Field
{
    protected static $name = 'Bepalingseenheid';
    protected static $type = "an";
    protected static $length = 9;
    protected static $varLength=true;
}