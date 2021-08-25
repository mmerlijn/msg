<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:40
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0214 extends Table
{
    protected static $name = 'Administrative Sex';
    protected static $table = [
        "CH" => "Child Health Assistance",
        "ES" => "Elective Surgery Program",
        "FP" => "Family Planning",
        "O" => "Other",
        "U" => "Unknown",
    ];
}