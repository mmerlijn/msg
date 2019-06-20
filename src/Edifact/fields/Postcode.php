<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Postcode extends Field
{
    protected static $name = 'Postcode';
    protected static $type = "an";
    protected static $length = 9;
    protected static $varLength=true;
}