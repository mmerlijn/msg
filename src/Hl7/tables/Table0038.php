<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 21:36
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0038 extends Table
{
    protected static $name='Order status';
    protected static $table=[
        "A"=>"Some, but not all, results available",
        "CA"=>"Order was canceled",
        "CM"=>"Order is completed",
        "DC"=>"Order was discontinued",
        "ER"=>"Error, order not found",
        "HD"=>"Order is on hold",
        "IP"=>"In process, unspecified",
        "RP"=>"Order has been replaced",
        "SC"=>"In process, scheduled",
    ];
}