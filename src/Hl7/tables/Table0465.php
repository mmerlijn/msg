<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 01:07
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0465 extends Table
{
    protected static $name = "Name/address representation";
    protected static $table = [
        "I" => "Ideographic (i.e., Kanji)",
        "A" => "Alphabetic (i.e., Default or some single-byte)",
        "P" => "Phonetic (i.e., ASCII, Katakana, Hiragana, etc.)",
    ];
}