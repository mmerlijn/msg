<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Result normalcy indicator, coded
class F7857 extends Field
{
    protected static $name = '7857';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['HI','LO','UN'];
    //HI Above high reference limit   LO Below low reference limit   UN Abnormal
}