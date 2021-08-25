<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Grenswaarde extends Field
{
    protected static $name = 'Grenswaarde';
    protected static $type = "an";
    protected static $length = 9;
    protected static $varLength=true;
}