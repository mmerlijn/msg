<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:16
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0116
{
    protected static $name = 'Bed Status';
    protected static $table = [
        "C" => "Closed",
        "H" => "Housekeeping",
        "O" => "Occupied",
        "U" => "Unoccupied",
        "K" => "Contaminated",
        "I" => "Isolated",
    ];
}