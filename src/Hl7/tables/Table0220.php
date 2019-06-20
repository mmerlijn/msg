<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:31
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0220 extends Table
{
    protected static $name='Living Arrangement';
    protected static $table=[
        "A"=>"Alone",
        "F"=>"Family",
        "I"=>"Institution",
        "R"=>"Relative",
        "U"=>"Unknown",
        "S"=>"Spouse Only",
    ];
}