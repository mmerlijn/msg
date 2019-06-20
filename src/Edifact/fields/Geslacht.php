<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Geslacht extends Field
{
    protected static $name = 'Geslacht';
    protected static $type = "a";
    protected static $length = 1;
    protected static $varLength=false;
    protected static $allowed=["M","V"]; //M = Man, V = Vrouw
}