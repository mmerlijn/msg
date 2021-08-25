<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:52
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0309 extends Table
{
    protected static $name = 'Coverage Type';
    protected static $table = [
        "H" => "Hospital/institutional",
        "P" => "Physician/professional",
        "B" => "Both hospital and physician",
    ];
}