<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F3227 extends Field
{
    protected static $name = '3227';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['H','L','P','PR','W'];
    // H Home   L Laboratory   P Practice   PR Prikplaats   W Ward
}