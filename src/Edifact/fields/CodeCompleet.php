<?php


namespace mmerlijn\msg\src\Edifact\fields;


class CodeCompleet extends Field
{
    protected static $name = 'CodeCompleet';
    protected static $type = "a";
    protected static $length = 1;
    protected static $varLength=false;
}