<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:32
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0205 extends Table
{
    protected static $name = 'Price type';
    protected static $table = [
        "AP" => "administrative price or handling fee",
        "DC" => "direct unit cost",
        "IC" => "indirect unit cost",
        "PF" => "professional fee for performing provider",
        "TF" => "technology fee for use of equipment",
        "TP" => "total price",
        "UP" => "unit price, may be based on length of procedure or service",
    ];
}