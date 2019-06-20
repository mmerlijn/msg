<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 01:02
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0190 extends Table
{
    protected static $name = "Address type";
    protected static $table = [
        "BA" => "Bad address",
        "N" => "Birth (nee) (birth address, not otherwise specified)",
        "BDL" => "Birth delivery location (address where birth occurred)",
        "F" => "Country Of Origin",
        "C" => "Current Or Temporary",
        "B" => "Firm/Business",
        "H" => "Home",
        "L" => "Legal Address",
        "M" => "Mailing",
        "O" => "Office",
        "P" => "Permanent",
        "RH" => "Registry home. Refers to the information system, typically managed by a public health agency, that stores patient information such as immunization histories or cancer data, regardless of where the patient obtains services.",
        "BR" => "Residence at birth (home address at time of birth)"
    ];
}