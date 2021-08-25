<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 11:07
 */
namespace mmerlijn\msg\src\Hl7\fields;

//ST_: String Data
//This field is for the MSH first 2 segments, normal string will be encoded/decoded

class ST_ extends Field
{
    protected static $name = 'ST_';

    //no validation needed
    public static function setFilled(string $data, string $seg, bool $component = false, bool $validate = false)
    {
        return $data;
    }

    public static function toHl7($tree, $depth)
    {
        return $tree;
    }
}