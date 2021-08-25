<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:29
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0524 extends Table
{
    protected static $name='Sequence condition';
    protected static $table=[
        "S"=>"Sequence conditions",
        "C"=>"Repeating cycle of orders",
        "R"=>"Reserved for possible future use",
    ];
}