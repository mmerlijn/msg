<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:41
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0093 extends Table
{
    protected static $name = 'Release Information';
    protected static $table = [
        "Y" => "Yes",
        "N" => "No",
        //and   …	user-defined codes
    ];
}