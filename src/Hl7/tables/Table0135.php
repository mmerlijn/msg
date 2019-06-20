<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:38
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0135 extends Table
{
    protected static $name = 'Assignment of Benefits';
    protected static $table = [
        "Y" => "Yes",
        "N" => "No",
        "M" => "Modified assignmen",
    ];
}