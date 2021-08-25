<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 01:23
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0201 extends Table
{
    protected static $name = "";
    protected static $table = [
        "PRN" => "Primary Residence Number",
        "ORN" => "Other Residence Number",
        "WPN" => "Work Number",
        "VHN" => "Vacation Home Number",
        "ASN" => "Answering Service Number",
        "EMR" => "Emergency Number",
        "NET" => "Network (email) Address",
        "BPN" => "eeper Number"
    ];
}