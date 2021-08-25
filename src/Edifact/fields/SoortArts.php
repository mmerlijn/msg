<?php


namespace mmerlijn\msg\src\Edifact\fields;


class SoortArts extends Field
{
    protected static $name = 'SoortArts';
    protected static $type = "a";
    protected static $length = 1;
    protected static $varLength=false;
}