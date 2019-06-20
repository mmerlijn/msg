<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 00:39
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0061 extends Table
{
    protected static $name = "Check digit scheme";
    protected static $table = [
        "NPI" => "Check digit algorithm in the US National Provider Identifier",
        "ISO" => "ISO 7064: 1983",
        "M10" => "Mod 10 algorithm",
        "M11" => "Mod 11 algorithm"
    ];
}