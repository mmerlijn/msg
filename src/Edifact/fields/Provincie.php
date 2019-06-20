<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Provincie extends Field
{
    protected static $name = 'Provincie';
    protected static $type = "a";
    protected static $length = 20;
    protected static $varLength=true;
}