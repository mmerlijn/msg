<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:51
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0017 extends Table
{
    protected static $name = 'Transaction Type';
    protected static $table = [
        "AJ" => "Adjustment",
        "CD" => "Credit",
        "CG" => "Charge",
        "CO" => "Co-payment",
        "PY" => "Payment",
    ];
}