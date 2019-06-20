<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Identificatienummer extends Field
{
    protected static $name = 'Identificatienummer';
    protected static $type = "an";
    protected static $length = 9;
    protected static $varLength=true;
}