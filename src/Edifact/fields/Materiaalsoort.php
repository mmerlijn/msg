<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Materiaalsoort extends Field
{
    protected static $name = 'Materiaalsoort';
    protected static $type = "an";
    protected static $length = 12;
    protected static $varLength=true;
}