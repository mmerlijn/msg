<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F3835 extends Field
{
    protected static $name = '3835';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['NAN','NEA','NEV','NVN','NVV'];

    // NAN Achternaam verkort   NEA Achternaam echtgenoot verkort   NEV Voorvoegsels echtgenoot   NVN Eerste voornaam   NVV Voorletters * voorvoegsels
}