<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:30
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0223 extends Table
{
    protected static $name='Living Dependency';
    protected static $table=[
        "S"=>"Spouse Dependent",
        "M"=>"Medical Supervision Required",
        "C"=>"Small Children Dependent",
        "O"=>"Other",
        "U"=>"Unknown",
    ];
}