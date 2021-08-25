<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:31
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0298 extends Table
{
    protected static $name = "Value type";
    protected static $table = [
        "P"=>"Pro-rate. Apply this price to this interval, pro-rated by whatever portion of the interval has occurred/been consumed",
        "F"=>"Flat-rate. Apply the entire price to this interval, do not pro-rate the price if the full interval has not occurred/been consumed",
    ];
}