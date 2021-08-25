<?php


namespace mmerlijn\msg\src\Edifact\fields;


class PatientReferentieNr extends Field
{
    protected static $name = 'PatientReferentieNr';
    protected static $type = "an";
    protected static $length = 12;
    protected static $varLength=true;
}