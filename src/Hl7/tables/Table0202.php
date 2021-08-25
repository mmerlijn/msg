<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 01:25
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0202 extends Table
{
    protected static $name = "";
    protected static $table = [
        "PH" => "Telephone",
        "FX" => "Fax",
        "MD" => "Modem",
        "CP" => "Cellular Phone",
        "BP" => "Beeper",
        "Internet" => "Internet Address: Use Only If Telecommunication Use Code Is NET",
        "X.400" => "X.400 email address: Use Only If Telecommunication Use Code Is NET",
        "TDD" => "Telecommunications D",
        "TTY" => "Teletypewriter"
    ];

}