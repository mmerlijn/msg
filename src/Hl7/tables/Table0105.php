<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:24
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0105 extends Table
{
    protected static $name = 'Source of comment';
    protected static $table = [
        "L" => "Ancillary (filler) department is source of comment",
        "P" => "Orderer (placer) is source of comment",
        "O" => "Other system is source of comment",
    ];
}