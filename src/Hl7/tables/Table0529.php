<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 02:14
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0529 extends Table
{
    protected static $name = "Precision";
    protected static $table = [
        "Y" => "year",
        "L" => "month",
        "D" => "day",
        "H" => "hour",
        "M" => "minute",
        "S" => "second",
    ];

}