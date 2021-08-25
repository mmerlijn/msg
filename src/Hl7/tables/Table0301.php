<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 00:49
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0301 extends Table
{
    protected static $name = "Universal ID type";
    protected static $table = [
        "DNS" => "An Internet dotted name. Either in ASCII or as integers",
        "GUID" => "Same as UUID.",
        "HCD" => "The CEN Healthcare Coding Scheme Designator. (Identifiers used in DICOM follow this assignment scheme.)",
        "HL7" => "Reserved for future HL7 registration schemes",
        "ISO" => "An International Standards Organization Object Identifier",
        "L,M,N" => "These are reserved for locally defined coding schemes.",
        "L" => "Local",
        "M" => "Local",
        "N" => "Local",
//Random	Usually a base64 encoded string of random bits. The uniqueness depends on the length of the bits. Mail systems often generate ASCII string “unique names," from a combination of random bits and system names. Obviously, such identifiers will not be constrained to the base64 character set.
        "URI" => "Uniform Resource Identifier",
        "UUID" => "The DCE Universal Unique Identifier",
        "x400" => "An X.400 MHS format identifier",
        "x500" => "An X.500 directory nam",
    ];
}