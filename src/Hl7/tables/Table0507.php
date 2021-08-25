<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 09:22
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0507 extends Table
{
    protected static $name = 'Observation Result Handling';
    protected static $table = [
        "F" => "Film-with-patient",
        "N" => "Notify provider when ready",
    ];
}