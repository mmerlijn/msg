<?php


namespace mmerlijn\msg\src\Edifact\fields;


class CodeBepaling extends Field
{
    protected static $name = 'CodeBepaling';
    protected static $type = "an";
    protected static $length = 10;
    protected static $varLength=true;
}