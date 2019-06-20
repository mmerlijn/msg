<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 29-1-2019
 * Time: 22:55
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table
{
    protected static $table=[];

    public static function getTable(){
        return static::$table;
    }

    public static function validate(string $data): bool
    {
        //if table is empty no error will be raised
        return count(static::$table)?
         key_exists($data, static::$table):
            true;
    }
}