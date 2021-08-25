<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Artscode extends Field
{
    protected static $name = 'Artscode';
    protected static $type = "an";
    protected static $length = 6;
    protected static $varLength=false;
}