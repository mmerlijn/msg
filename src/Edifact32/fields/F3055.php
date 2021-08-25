<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Code list responsible agency, coded
class F3055 extends Field
{
    protected static $name = '3055';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=false;
    protected static $allowed=['ITN','LLB','LOC','LZB','NHG','NVK','SAN','VEK','WCC'];
// ITN NL, ITN (Stichting Interconnectiviteit Telematica Nederland)
// LLB Lokaal patiëntenbestand laboratorium (laboratoria)
// LOC NL, Lokaal afgesproken
// LZB Lokaal patiëntenbestand ziekenhuis/ziekenhuizen
// NHG NL, Nederlands Huisartsen Genootschap
// NVK NL, Nederlandse Vereniging voor Klinische Chemie
// SAN NL, Samenwerkende Artsenlaboratoria Nederland
// VEK NL, Vektis BV
// WCC NL, Vaste Commissie voor Classificaties en Definities
}