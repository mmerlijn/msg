<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 21:39
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0121 extends Table
{
    protected static $name='Response flag';
    protected static $table=[
        "E"=>"Report exceptions only",
        "R"=>"Same as E, also Replacement and Parent-Child",
        "D"=>"Same as R, also other associated segments",
        "F"=>"Same as D, plus confirmations explicitly",
        "N"=>"Only the MSA segment is returned",
    ];
}