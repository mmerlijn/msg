<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Postbus extends Field
{
    protected static $name = 'Postbus';
    protected static $type = "N";
    protected static $length = 8;
    protected static $varLength=true;
}