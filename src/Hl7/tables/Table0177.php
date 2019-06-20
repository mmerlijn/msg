<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 21:50
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0177 extends Table
{
    protected static $name='Confidentiality code';
    protected static $table=[
        "V"=>"Very restricted",
        "R"=>"Restricted",
        "U"=>"Usual control",
        "EMP"=>"Employee",
        "UWM"=>"Unwed mother",
        "VIP"=>"Very important person or celebrity",
        "PSY"=>"Psychiatric patient",
        "AID"=>"AIDS patient",
        "HIV"=>"HIV(+) patient",
        "ETH"=>"Alcohol/drug treatment patient",
    ];
}