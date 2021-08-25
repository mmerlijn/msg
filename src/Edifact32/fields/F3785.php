<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Address type, coded
class F3785 extends Field
{
    protected static $name = '3785';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['PH','PO'];
}