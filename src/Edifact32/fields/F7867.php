<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Specimen characteristic identification
class F7867 extends Field
{
    protected static $name = '7867';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['ATT','PAT','SPR','ZZZ'];

    // ATT Sample collected   PAT Sample to be received from patient   SPR Sample to be collected by service provider   ZZZ Code te groot voor dit veld
}