<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 16:46
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0204 extends Table
{
    protected static $name='Organizational name type';
    protected static $table=[
        "A"=>"Alias name",
        "L"=>"Legal name",
        "D"=>"Display name",
        "SL"=>"Stock exchange listing name",
    ];
}