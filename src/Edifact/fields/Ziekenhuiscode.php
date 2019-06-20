<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Ziekenhuiscode extends Field
{
    protected static $name = 'Ziekenhuiscode';
    protected static $type = "n";
    protected static $length = 3;
    protected static $varLength=false;
}