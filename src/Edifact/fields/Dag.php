<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Dag extends Field
{
    protected static $name = 'Dag';
    protected static $type = "n";
    protected static $length = 2;
    protected static $varLength = false;
    protected static $format = "d";
}