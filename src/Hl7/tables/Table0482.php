<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 21:56
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0482 extends Field
{
    protected static $name='Order Type';
    protected static $table=[
        "I"=>"Inpatient Order",
        "O"=>"Outpatient Order",
    ];
}