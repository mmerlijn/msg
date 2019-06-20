<?php


namespace mmerlijn\msg\src\Edifact\fields;


class Bloedgroep extends Field
{
    protected static $name = 'Bloedgroep';
    protected static $type = "an";
    protected static $length = 20;
    protected static $varLength=true;
}