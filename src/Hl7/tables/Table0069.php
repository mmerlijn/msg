<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:52
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0069 extends Table
{
    protected static $name = 'Hospital Service';
    protected static $table = [
        "MED" => "Medical Service",
        "SUR" => "Surgical Service",
        "URO" => "Urology Service",
        "PUL" => "Pulmonary Service",
        "CAR" => "Cardiac Service",
    ];
}