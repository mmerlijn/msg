<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:18
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0191 extends Table
{
    protected static $name = "Type of referenced data";
    protected static $table = [
        "AP" => "Other application data, typically uninterpreted binary data (HL7 V2.3 and later)",
        "AU" => "Audio data (HL7 V2.3 and later)",
        "FT" => "Formatted text (HL7 V2.2 only)",
        "IM" => "Image data (HL7 V2.3 and later)",
        "multipart" => "MIME multipart package",
        "NS" => "Non-scanned image (HL7 V2.2 only)",
        "SD" => "Scanned document (HL7 V2.2 only)",
        "SI" => "Scanned image (HL7 V2.2 only)",
        "TEXT" => "Machine readable text document (HL7 V2.3.1 and later)",
        "TX" => "Machine readable text document (HL7 V2.2 only)",
    ];
}