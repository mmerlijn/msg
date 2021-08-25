<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:13
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0004 extends Table
{
    protected static $name="Patient class";
    protected static $table=[
        "E"=>"Emergency",
        "I"=>"Inpatient",
        "O"=>"Outpatient",
        "P"=>"Preadmit",
        "R"=>"Recurring patient",
        "B"=>"Obstetrics",
        "C"=>"Commercial Account",
        "N"=>"Not Applicable",
        "U"=>"Unknown",
    ];
}