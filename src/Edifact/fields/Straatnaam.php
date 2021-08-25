<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Straatnaam extends Field
{
    protected static $name = 'Straatnaam';
    protected static $type = "an";
    protected static $length = 30;
    protected static $varLength=true;
}