<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Clinical information qualifier
class F6810 extends Field
{
    protected static $name = '6810';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['BLG','DIA','DLA'];

    // BLG Bloedgroep   DIA Diagnose aanvraag   DLA Diagnose laboratorium
}