<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:31
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0472 extends Table
{
    protected static $name='TQ conjunction ID';
    protected static $table=[
        "S"=>"Synchronous",
        "A"=>"Asynchronous",
        "C"=>"Actuation Time",
];
}