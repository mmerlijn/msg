<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:56
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0023 extends Table
{
    protected static $name = 'Admit Source';
    protected static $table = [
        "1" => "Physician referral",
        "2" => "Clinic referral",
        "3" => "HMO referral",
        "4" => "Transfer from a hospital",
        "5" => "Transfer from a skilled nursing facility",
        "6" => "Transfer from another health care facility",
        "7" => "Emergency room",
        "8" => "Court/law enforcement",
        "9" => "Information not available",
    ];
}