<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Party qualifier
class F3035 extends Field
{
    protected static $name = '3035';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['CCR','PAT','PO','SLA'];

    // CCR Intended recipient of report (Copy destination of report)
    // PAT Patiënt
    // PO Laboratory service requester (ordering party) = de aanvrager van het laboratorium-diagnostisch onderzoek
    // SLA Laboratory service provider = de uitvoerende partij van het laboratoriumdiagnostisch onderzoek
}