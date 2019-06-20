<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:21
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0326 extends Table
{
    protected static $name = 'Visit Indicator';
    protected static $table = [
        "A" => "Account level (default)",
        "V" => "Visit level",
    ];
}