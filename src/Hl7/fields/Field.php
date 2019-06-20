<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 10:23
 */

namespace mmerlijn\msg\src\Hl7\fields;


class Field
{
    public static function setEmpty($component=false)
    {
        return "";
    }

    public static function setFilled(string $data,string $seg,bool $component=false,bool $validate=false)
    {
        return $data;
    }

    public static function toHl7($tree,$depth)
    {
        return $tree;
    }
    public static function getData($tree,array $depthElement)
    {

    }
    public static function name(){
        return static::$name;
    }
    public static function getName(){
        return static::$name;
    }
}