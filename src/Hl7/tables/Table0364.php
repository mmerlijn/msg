<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:26
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0364 extends Table
{
    protected static $name='Comment type';
    protected static $table=[
        "PI"=>"Patient Instructions",
        "AI"=>"Ancillary Instructions",
        "GI"=>"General Instructions",
        "1R"=>"Primary Reason",
        "2R"=>"Secondary Reason",
        "GR"=>"General Reason",
        "RE"=>"Remark",
        "DR"=>"Duplicate/Interaction Reason",
    ];
}