<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Communication channel qualifier
class F3155 extends Field
{
    protected static $name = '3155';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['MO','SE','TE','TE1','TE2','01','03','09','80'];
// FX Telefax
//   MO Modem
//   SE Semaphone
//   TE Telephone
//   TE1 Telefoon thuis
//   TE2 Telefoon werk
//+(“01” telefoonnummer)+(“03” fax nummer)+(“09” mobiele telefoonnummer)+(“80” telefoonnummer vrije tekst)
}