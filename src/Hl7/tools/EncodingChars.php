<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 16:51
 */

namespace mmerlijn\msg\src\Hl7\tools;


class EncodingChars
{
    protected static $charsEncoding = array("é" => 'e', "è" => 'e', "ë" => 'e', "ê" => 'e', "É" => 'E', "È" => 'E', "Ë" => 'E', "Ê" => 'E', "á" => 'a', "à" => 'a', "ä" => 'a', "â" => 'a', "å" => 'a', "Á" => 'A', "À" => 'A', "Ä" => 'A', "Â" => 'A', "Å" => 'A', "ó" => 'o', "ò" => 'o', "ö" => 'o', "ô" => 'o', "Ó" => 'O', "Ò" => 'O', "Ö" => 'O', "Ô" => 'O', "í" => 'i', "ì" => 'i', "ï" => 'i', "î" => 'i', "Í" => 'I', "Ì" => 'I', "Ï" => 'I', "Î" => 'I', "ú" => 'u', "ù" => 'u', "ü" => 'u', "û" => 'u', "Ú" => 'U', "Ù" => 'U', "Ü" => 'U', "Û" => 'U', "ý" => 'y', "ÿ" => 'y', "Ý" => 'Y', "ø" => 'o', "Ø" => 'O', "œ" => 'a', "Œ" => 'A', "Æ" => 'A', "ç" => 'c', "Ç" => 'C');

    protected static $segmentSeparator = '\n';
    protected static $fieldSeparator = '|';
    protected static $componentSeparator = '^';
    protected static $subComponentSeparator = '&';
    protected static $repetitionSeparator = '~';
    protected static $escapeChar = '\\';
    protected static $hl7Version = '2.4';

    public static function setSeparator($separators=['|','^','~','\\','&','|'])
    {
        static::$fieldSeparator = $separators[0];
        static::$componentSeparator = $separators[1];
        static::$repetitionSeparator = $separators[2];
        static::$escapeChar = $separators[3];
        static::$subComponentSeparator = $separators[4];
    }

    public static function getSegmentSeparator()
    {
        return static::$segmentSeparator;
    }

    public static function getFieldSeparator()
    {
        return static::$fieldSeparator;
    }

    public static function getComponentSeparator()
    {
        return static::$componentSeparator;
    }

    public static function getSubComponentSeparator()
    {
        return static::$subComponentSeparator;
    }

    public static function getRepetitionSeparator()
    {
        return static::$repetitionSeparator;
    }

    public static function getEscapeChar()
    {
        return static::$escapeChar;
    }

    public static function getVersion()
    {
        return static::$hl7Version;
    }

    public static function getEncodingChar($depth)
    {
        switch ($depth) {
            case 1:
                return static::$fieldSeparator;
                break;
            case 2:
                return static::$componentSeparator;
                break;
            case 3:
                return static::$subComponentSeparator;
                break;
        }
    }

    public static function encode(string $string): string
    {
        $string = str_replace(static::$escapeChar, '\\E\\', $string);
        //voor het opbouwen van een HL7 bericht
        $string = str_replace(
            [
                static::$fieldSeparator, // |
                static::$repetitionSeparator, // ~
                static::$componentSeparator, // ^
                static::$subComponentSeparator, //&
                '<br>',
                '<b>',
                '<strong>',
                '</b>',
                '</strong>',
            ]
            ,
            [
                '\\F\\', // |
                '\\R\\', // ~
                '\\S\\', // ^
                '\\T\\', // &
                '\\.br\\', //carriage return
                '\\H\\', // Start highlighting
                '\\H\\', // Start highlighting
                '\\N\\', //Normal text (end highlighting)
                '\\N\\', //Normal text (end highlighting)

            ]
            , $string);
        //str_replace werkt niet goed met line breaks dus vandaar onderstaande voor line breaks
        $string = preg_replace("/[\n\r]/", '\\.br\\', $string);


        return trim(static::encodeChars($string));
    }

    public static function decode(string $string): string
    {
        $string = str_replace(
            [
                '\\F\\', // |
                '\\R\\', // ~
                '\\S\\', // ^
                '\\T\\', // &
                '\\H\\', // Start highlighting not converted    DSP| TOTAL CHOLESTEROL \H\240*\N\ [90 - 200] zou bijvoorbeeld vervangen kunnen worden door <strong>
                '\\N\\', //Normal text (end highlighting) not converted
                '\\.br\\', //carriage return
                '\\.fi\\', // Begin word wrap or fill mode. This is the default state. It can be changed to a no-wrap mode using the .nf command
                '\\.nf\\',  //Begin no-wrap mode.
                '\\.ce\\',  //End current output line and center the next line.
            ],
            [
                static::$fieldSeparator, // |
                static::$repetitionSeparator, // ~
                static::$componentSeparator, // ^
                static::$subComponentSeparator, //&
                '', //highlighting start
                '', //highlighting end
                '\n', //carriage return
                '', //fi
                '', //nf
                '', //ce
            ], $string);
        //$string = str_replace('\\E\\', static::$escapeChar, $string); //we don't want backslashes in messages, replace for forward slash 20-11-2019
        $string = str_replace('\\E\\', "/", $string); //we don't want backslashes in messages, replace for forward slash 20-11-2019
        $string = preg_replace('/\\\(\.((in)|(ti)|(sk))\d{1,2})\\\/', '', $string);
        $string = preg_replace('/\*(.)*\*/', '', $string);

        /* TODO
                '\\Cxxyy\\',  //  '/\\(C[0-9a-f]{2})\\/i'
               '\\Mxxyyzz\\',        //  '/\\(M[0-9a-f]{3})\\/i'
                '\\Xdd\\',            //  '/\\(X[0-9a-f]{1})\\/i'
                '\\Zdd\\',
                '\\X0A\\',  // Line Feed
                '\\X0D\\', //Carriage return
                '\\.inxx\\', //  '/\\(\.in\d{1,2})\\/'    //Indent <number> of spaces, where <number> is a positive or negative integer. This command cannot appear after the first printable character of a line.
                '\\.tixx\\', // '/\\(\.ti\d{1,2})\\/'   Temporarily indent <number> of spaces where number is a positive or negative integer. This command cannot appear after the first printable character of a line.
                '\\.skxx\\', //  '/\\(\.sk\d{1,2})\\/'  //  Skip <number> spaces to the right.
                        //allemaal tegelijkertijd  '/\\(\.((in)|(ti)|(sk))\d{1,2})\\/'
        */
        //return trim(static::encodeChars($string));
        return trim($string);
    }

    public static function encodeChars(string $string): string
    {
        //https://stackoverflow.com/questions/14114411/remove-all-special-characters-from-a-string
        $utf8 = [
            '/[áàâãªäåœ]/u'   =>   'a',
            '/[ÁÀÂÃÄÅŒÆ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºöø]/u'   =>   'o',
            '/[ÓÒÔÕÖØ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/[ýÿ]/u'     =>   'y',
            '/[Ý]/u'     =>   'y',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        ];
        return preg_replace(array_keys($utf8), array_values($utf8), $string)?:"";
        //return str_replace(array_keys(static::$charsEncoding), static::$charsEncoding, $string);
    }
}