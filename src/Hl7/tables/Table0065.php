<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:19
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0065 extends Table
{
    protected static $name='Administrative Sex';
    protected static $table=[
        "A"=>"Add ordered tests to the existing specimen",
        "G"=>"Generated order; reflex order",
        "L"=>"Lab to obtain specimen from patient",
        "O"=>"Specimen obtained by service other than Lab",
        "P"=>"Pending specimen; Order sent prior to delivery",
        "R"=>"Revised order",
        "S"=>"Schedule the tests specified below",
    ];
}