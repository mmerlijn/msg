<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 01:15
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0200 extends Table
{
    protected static $name = "Name type";
    protected static $table = [
        "A" => "Alias Name",
        "B" => "Name at Birth",
        "C" => "Adopted Name",
        "D" => "Display Name",
        "I" => "Licensing Name",
        "L" => "Legal Name",
        "M" => "Maiden Name",
        "N" => "Nickname /”Call me” Name/Street Name",
        "P" => "Name of Partner/Spouse (retained for backward compatibility only)",
        "R" => "Registered Name (animals only)",
        "S" => "Coded Pseudo-Name to ensure anonymity",
        "T" => "Indigenous/Tribal/Community Name",
        "U" => "Unspecified",
    ];
}