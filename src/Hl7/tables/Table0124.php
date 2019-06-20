<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 09:19
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0124 extends Table
{
    protected static $name = 'Transportation Mode';
    protected static $table = [
        "CART" => "Cart - patient travels on cart or gurney",
        "PORT" => "The examining device goes to patient's location",
        "WALK" => "Patient walks to diagnostic service",
        "WHLC" => "Wheelchair",
    ];
}