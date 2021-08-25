<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Uitslag extends Field
{
    protected static $name = 'Uitslag';
    protected static $type = "an";
    protected static $length = 9;
    protected static $varLength=true;
}