<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 16:51
 */

namespace mmerlijn\msg\src\Edifact\tools;


class EncodingChars
{
    protected static $charsEncoding = array("é" => 'e', "è" => 'e', "ë" => 'e', "ê" => 'e', "É" => 'E', "È" => 'E', "Ë" => 'E', "Ê" => 'E', "á" => 'a', "à" => 'a', "ä" => 'a', "â" => 'a', "å" => 'a', "Á" => 'A', "À" => 'A', "Ä" => 'A', "Â" => 'A', "Å" => 'A', "ó" => 'o', "ò" => 'o', "ö" => 'o', "ô" => 'o', "Ó" => 'O', "Ò" => 'O', "Ö" => 'O', "Ô" => 'O', "í" => 'i', "ì" => 'i', "ï" => 'i', "î" => 'i', "Í" => 'I', "Ì" => 'I', "Ï" => 'I', "Î" => 'I', "ú" => 'u', "ù" => 'u', "ü" => 'u', "û" => 'u', "Ú" => 'U', "Ù" => 'U', "Ü" => 'U', "Û" => 'U', "ý" => 'y', "ÿ" => 'y', "Ý" => 'Y', "ø" => 'o', "Ø" => 'O', "œ" => 'a', "Œ" => 'A', "Æ" => 'A', "ç" => 'c', "Ç" => 'C');

    protected static $componentDataElementSeparator=":";
    protected static $dataElementSeparator ="+";
    protected static $decimalMark=".";
    protected static $releaseCharacter="?"; //=escape char for :+
    protected static $reserved=" ";
    protected static $segmentTerminator="'";
    protected static $escapeChar = '\\';






    public static function setSeparator($separators=[":","+",".","?"," ","'"])
    {
        static::$componentDataElementSeparator = $separators[0];
        static::$dataElementSeparator = $separators[1];
        static::$decimalMark = $separators[2];
        static::$releaseCharacter = $separators[3];
        static::$reserved = $separators[4];
        static::$segmentTerminator = $separators[5];
    }

    public static function getComponentDataElementSeparator()
    {
        return static::$componentDataElementSeparator;
    }

    public static function getDataElementSeparator()
    {
        return static::$dataElementSeparator;
    }

    public static function getDecimalMark()
    {
        return static::$decimalMark;
    }


    public static function getReleaseCharacter()
    {
        return static::$releaseCharacter;
    }

    public static function getReserved()
    {
        return static::$reserved;
    }

    public static function getSegmentTerminator()
    {
        return static::$segmentTerminator;
    }

    public static function getEncodingChar($depth)
    {
        switch ($depth) {
            case 1:
                return static::$dataElementSeparator;
                break;
            case 2:
                return static::$componentDataElementSeparator;
                break;
        }
    }


    //hier verder
    public static function encode(string $string): string
    {
        $string = str_replace(static::$escapeChar, '\\E\\', $string);
        //voor het opbouwen van een Edifact bericht
        $string = str_replace(
            [
                static::$releaseCharacter, // ?^
                static::$componentDataElementSeparator, // :
                static::$dataElementSeparator, // +
                static::$segmentTerminator, //'
                '\n\r',
                '\n', //carriage return
                '\r',
            ]
            ,
            [
                static::$releaseCharacter.static::$releaseCharacter, // ?^
                static::$releaseCharacter.static::$componentDataElementSeparator, // :
                static::$releaseCharacter.static::$dataElementSeparator, // +
                static::$releaseCharacter.static::$segmentTerminator, //'
                '',
                '',
                '',
            ]
            , $string);

        return trim(static::encodeChars($string));
    }

    public static function decode(string $string): string
    {
        $string = str_replace(
            [
                static::$releaseCharacter.static::$componentDataElementSeparator, // :
                static::$releaseCharacter.static::$dataElementSeparator, // +
                static::$releaseCharacter.static::$releaseCharacter, // ?^
                static::$releaseCharacter.static::$segmentTerminator, //'
            ],
            [
                static::$componentDataElementSeparator, // :
                static::$dataElementSeparator, // +
                static::$releaseCharacter, // ?^
                static::$segmentTerminator, //'
            ], $string);
        return trim($string);
    }

    private static function encodeChars(string $string): string
    {
        return str_replace(array_keys(static::$charsEncoding), static::$charsEncoding, $string);
    }
}