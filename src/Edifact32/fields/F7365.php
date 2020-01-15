<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F7365 extends Field
{
    protected static $name = '7365';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['B','G','M','N','P'];

    // B Nog uit te voeren uitslag   G Uitslag compleet   M Change   N New   P Gedeeltelijke uitslag
}