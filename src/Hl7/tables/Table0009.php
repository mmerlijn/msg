<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:58
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0009 extends Table
{
    protected static $name = 'Ambulatory Status';
    protected static $table = [
        "A0" => "No functional limitations",
        "A1" => "Ambulates with assistive device",
        "A2" => "Wheelchair/stretcher bound",
        "A3" => "Comatose; non-responsive",
        "A4" => "Disoriented",
        "A5" => "Vision impaired",
        "A6" => "Hearing impaired",
        "A7" => "Speech impaired",
        "A8" => "Non-English speaking",
        "A9" => "Functional level unknown",
        "B1" => "Oxygen therapy",
        "B2" => "Special equipment (tubes, IVs, catheters)",
        "B3" => "Amputee",
        "B4" => "Mastectomy",
        "B5" => "Paraplegic",
        "B6" => "Pregnant",
    ];
}