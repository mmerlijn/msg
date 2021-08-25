<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:09
 */

namespace mmerlijn\msg\src\Hl7\tables;


use mmerlijn\msg\src\Hl7\Exceptions\CodeException;
use mmerlijn\msg\src\Hl7\fields\AD;
use mmerlijn\msg\src\Hl7\fields\CE;
use mmerlijn\msg\src\Hl7\fields\CF;
use mmerlijn\msg\src\Hl7\fields\CP;
use mmerlijn\msg\src\Hl7\fields\CX;
use mmerlijn\msg\src\Hl7\fields\DT;
use mmerlijn\msg\src\Hl7\fields\ED;
use mmerlijn\msg\src\Hl7\fields\FT;
use mmerlijn\msg\src\Hl7\fields\MO;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\RP;
use mmerlijn\msg\src\Hl7\fields\SN;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TM;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\fields\TX;
use mmerlijn\msg\src\Hl7\fields\XAD;
use mmerlijn\msg\src\Hl7\fields\XCN;
use mmerlijn\msg\src\Hl7\fields\XON;
use mmerlijn\msg\src\Hl7\fields\XPN;
use mmerlijn\msg\src\Hl7\fields\XTN;

class Table0125 extends Table
{
    protected static $name = "Value type";
    protected static $table = [
        "AD" => "Address",
        "CE" => "Coded Entry",
        "CF" => "Coded Element With Formatted Values",
        "CK" => "Composite ID With Check Digit",
        "CN" => "Composite ID And Name",
        "CP" => "Composite Price",
        "CX" => "Extended Composite ID With Check Digit",
        "DT" => "Date",
        "ED" => "Encapsulated Data",
        "FT" => "Formatted Text (Display)",
        "MO" => "Money",
        "NM" => "Numeric",
        "PN" => "Person Name",
        "RP" => "Reference Pointer",
        "SN" => "Structured Numeric",
        "ST" => "String Data.",
        "TM" => "Time",
        "TN" => "Telephone Number",
        "TS" => "Time Stamp (Date & Time)",
        "TX" => "Text Data (Display)",
        "XAD" => "Extended Address",
        "XCN" => "Extended Composite Name And Number For Persons",
        "XON" => "Extended Composite Name And Number For Organizations",
        "XPN" => "Extended Person Name",
        "XTN" => "Extended Telecommunications Number",
    ];
    private static $classes = [
        "AD" =>AD::class,   //array
        "CE" =>CE::class,   //array
        "CF" =>CF::class,   //string
        // "CK" =>CK::class,
        //"CN" =>CN::class,
        "CP" =>CP::class,   //array
        "CX" =>CX::class,   //array
        "DT" =>DT::class,   //time (string)
        "ED" =>ED::class,   //array
        "FT" =>FT::class,   //string
        "MO" =>MO::class,   //array
        "NM" =>NM::class,   //string (number)
        //"PN" =>PN::class,
        "RP" =>RP::class,   //array
        "SN" =>SN::class,   //array
        "ST" =>ST::class,   //string
        "TM" =>TM::class,   //string
        //"TN" =>TN::class",
        "TS" =>TS::class,   //array
        "TX" =>TX::class,   //string
        "XAD" =>XAD::class,
        "XCN" =>XCN::class,
        "XON" =>XON::class,
        "XPN" =>XPN::class,
        "XTN" =>XTN::class,
    ];

    public static function getClass(string $string)
    {
        if(in_array($string, array_keys(static::$classes))){
            return static::$classes[$string];
        }else{
            throw new CodeException('ERROR class '.$string.' is not set in Table0125. Expected class of: '.implode(", ", array_keys(static::$classes)));
        }
    }
}