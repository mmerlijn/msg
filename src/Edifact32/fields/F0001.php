<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F0001 extends Field
{

    protected static $name = '0001';
    protected static $type = "a";
    protected static $length = 4;
    protected static $allowed=['UNOA','UNOB','UNOC','UNOD','UNOE','UNOF'];
    protected static $varLength=false;

}