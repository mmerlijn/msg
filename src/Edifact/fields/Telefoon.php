<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Telefoon extends Field
{
    protected static $name = 'Telefoon';
    protected static $type = "an";
    protected static $length = 20;
    protected static $varLength=true;
}