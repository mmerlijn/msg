<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 21:59
 */

namespace mmerlijn\msg\src\Hl7\tables;

class Table0483 extends Table
{
    protected static $name='Authorization Mode';
    protected static $table=[
        "EL"=>"Electronic",
        "EM"=>"E-mail",
        "FX"=>"Fax",
        "IP"=>"In Person",
        "MA"=>"Mail",
        "PA"=>"Paper",
        "PH"=>"Phone",
        "RE"=>"Reflexive (Automated system)",
        "VC"=>"Video-conference",
        "VO"=>"Voice",
    ];
}