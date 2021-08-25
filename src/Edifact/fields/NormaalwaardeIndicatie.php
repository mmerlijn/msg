<?php


namespace mmerlijn\msg\src\Edifact\fields;


class NormaalwaardeIndicatie extends Field
{
    protected static $name = 'NormaalwaardeIndicatie';
    protected static $type = "an";
    protected static $length = 1;
    protected static $varLength=false;
}