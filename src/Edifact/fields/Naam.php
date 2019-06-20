<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Naam extends Field
{
    protected static $name = 'Naam';
    protected static $type = "an";
    protected static $length = 70;
    protected static $varLength=true;
}