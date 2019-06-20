<?php


namespace mmerlijn\msg\src\Edifact\fields;


class KopieRapport extends Field
{
    protected static $name = 'Bloedgroep';
    protected static $type = "an";
    protected static $length = 4;
    protected static $varLength=true;
    protected static $allowed=['VAN','NAAR'];
}