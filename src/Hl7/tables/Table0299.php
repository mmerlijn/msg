<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:26
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0299 extends Table
{
    protected static $name = "Value type";
    protected static $table = [
        "A" => "No encoding - data are displayable ASCII characters.",
        "Hex" => 'Hexadecimal encoding - consecutive pairs of hexadecimal digits represent consecutive single octets.',
        "Base64" => 'Encoding as defined by MIME (Multipurpose Internet Mail Extensions) standard RFC 1521. Four consecutive ASCII characters represent three consecutive octets of binary data. Base64 utilizes a 65-character subset of US-ASCII, consisting of both the upper and lower case alphabetic characters, digits "0" through “9”, “+", “/", and “=”.',
    ];
}