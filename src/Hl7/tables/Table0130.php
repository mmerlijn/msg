<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:36
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0130 extends Table
{
    protected static $name = 'Visit User Code';
    protected static $table = [
        "TE" => "Teaching",
        "HO" => "Home",
        "MO" => "Mobile Unit",
        "PH" => "Phone",
    ];
}