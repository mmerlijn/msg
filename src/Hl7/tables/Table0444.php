<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 01:19
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0444 extends Table
{
    protected static $name = "Name assembly order";
    protected static $table = [
        "G" => "Prefix Given Middle Family Suffix",
        "F" => "Prefix Family Middle Given Suffix",
    ];
}