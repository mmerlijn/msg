<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 12:58
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0211 extends Table
{
    protected static $name="Alternate character sets";
    protected static $table=[
        "ASCII"=>"The printable 7-bit ASCII character set.",
        "8859/1"=>"he printable characters from the ISO 8859/1 Character set",
        "8859/2"=>"The printable characters from the ISO 8859/2 Character set",
        "8859/3"=>"The printable characters from the ISO 8859/3 Character set",
        "8859/4"=>"The printable characters from the ISO 8859/4 Character set",
        "8859/5"=>"The printable characters from the ISO 8859/5 Character set",
        "8859/6"=>"The printable characters from the ISO 8859/6 Character set",
        "8859/7"=>"The printable characters from the ISO 8859/7 Character set",
        "8859/8"=>"The printable characters from the ISO 8859/8 Character set",
        "8859/9"=>"The printable characters from the ISO 8859/9 Character set",
        "ISO IR14"=>"Code for Information Exchange (one byte)(JIS X 0201-1976).",
        "ISO IR87"=>"Code for the Japanese Graphic Character set for information interchange (JIS X 0208-1990),",
        "ISO IR159"=>"Code of the supplementary Japanese Graphic Character set for information interchange (JIS X 0212-1990).",
        "GB 18030-2000"=>"Code for Chinese Character Set (GB 18030-2000)",
        "KS X 1001"=>"Code for Korean Character Set (KS X 1001)",
        "CNS 11643-1992"=>"Code for Taiwanese Character Set (CNS 11643-1992)",
        "BIG-5"=>"Code for Taiwanese Character Set (BIG-5)",
        "UNICODE"=>"The world wide character standard from ISO/IEC 10646-1-1993[6]",
        "UNICODE UTF-8"=>"UCS Transformation Format, 8-bit form",
        "UNICODE UTF-16"=>"UCS Transformation Format, 16-bit form",
        "UNICODE UTF-32"=>"UCS Transformation Format, 32-bit form",
    ];
}