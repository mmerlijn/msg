<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Specimen characteristic qualifier
class F7863 extends Field
{
    protected static $name = '7863';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['SCI','TSP'];
    // SCI Sampling performed indicator   TSP Type of sample
}