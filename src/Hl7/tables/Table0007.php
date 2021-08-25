<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:51
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0007 extends Table
{
    protected static $name = 'Admission Type';
    protected static $table = [
        "A" => "Accident",
        "E" => "Emergency",
        "L" => "Labor and Delivery",
        "R" => "Routine",
        "N" => "Newborn (Birth in healthcare facility)",
        "U" => "Urgent",
        "C" => "Elective",
    ];
}