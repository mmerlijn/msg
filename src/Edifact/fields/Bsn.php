<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Bsn extends Field
{
    protected static $name = 'Bsn';
    protected static $type = "an";
    protected static $length = 12;
    protected static $varLength=true;
}