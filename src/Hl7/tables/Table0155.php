<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 12:56
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0155 extends Table
{
    protected static $name = "Accept/application acknowledgment conditions";
    protected static $table = [
        "AL" => "Always",
        "NE" => "Never",
        "ER" => "Error/reject conditions only",
        "SU" => "Successful completion only",
    ];
}