<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 10:20
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0291 extends Table
{
    protected static $name = "Type of referenced data";
    protected static $table = [
        "BASIC" => "ISDN PCM audio data",
        "DICOM" => "Digital Imaging and Communications in Medicine",
        "FAX" => "Facsimile data",
        "GIF" => "Graphics Interchange Format",
        "HTML" => "Hypertext Markup Language",
        "JOT" => "Electronic ink data (Jot 1.0 standard)",
        "JPEG" => "Joint Photographic Experts Group",
        "Octet-stream" => "Uninterpreted binary data",
        "PICT" => "PICT format image data",
        "PostScript" => "PostScript program",
        "RTF" => "Rich Text Format",
        "SGML" => "Standard Generalized Markup Language (HL7 V2.3.1 and later)",
        "TIFF" => "TIFF image data",
        "x-hl7-cda-level-one" => "HL7 Clinical Document Architecture Level One document",
        "XML" => "Extensible Markup Language (HL7 V2.3.1 and later)",
    ];
}