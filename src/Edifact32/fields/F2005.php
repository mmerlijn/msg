<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class F2005 extends Field
{
    protected static $name = '2005';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=false;
    protected static $allowed=['137','187','329','AIC','AIP','CIC','ISO','ISR','SCO','SRI'];
    // 137 document message datetime
    // 187 authentication datetime of document
    // 329 Datetime of birth
    // AIC datetime of clinical inverstigation
    // AIP Datetime investigation preformed
    // CIC datetime of clinical information
    // ISO datetime of clinical information
    // ISR Issue datetime of report
    // SCO Datetime of sample collection
    // SRI datetime of receipt of collected sample
}