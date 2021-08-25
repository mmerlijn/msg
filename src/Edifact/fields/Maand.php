<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Maand extends Field
{
    protected static $name = 'Maand';
    protected static $type = "n";
    protected static $length = 2;
    protected static $varLength = false;
    protected static $format = "m";
}