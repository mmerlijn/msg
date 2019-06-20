<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:50
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0066 extends Table
{
    protected static $name = 'Employment Status';
    protected static $table = [
        "1" => "Full time employed",
        "2" => "Part time employed",
        "4" => "Self-employed,",
        "C" => "Contract, per diem",
        "L" => "Leave of absence (e.g. Family leave, sabbatical, etc.)",
        "T" => "Temporarily unemployed",
        "3" => "Unemployed",
        "5" => "Retired",
        "6" => "On active military duty",
        "O" => "Other",
        "9" => "Unknown",
    ];
}