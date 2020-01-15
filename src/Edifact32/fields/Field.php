<?php


namespace mmerlijn\msg\src\Edifact32\fields;


use mmerlijn\msg\src\Edifact32\tools\EncodingChars;

class Field
{
    protected static $name = '';
    protected static $type = "an";
    protected static $length = 0;
    protected static $varLength = true;
    protected static $allowed = null;
    protected static $structure = [];

    public static function setFilled(string $data, string $seg, bool $validate = false)
    {
        return [0=>static::class,1=>EncodingChars::decode($data)];
    }

    public static function setEmpty()
    {
        return [0=>static::class,1=>""];
    }

    protected static function checkType($data): bool
    {
        switch (static::$type) {
            case "a":
                if (preg_match("/[a-Z]/", $data)) {
                    return true;
                }
                break;
            case "n":
                if (is_numeric($data)) {
                    return true;
                }
                break;
            case "an":
                return true;
                break;
            default:
                return false;

        }
    }

    protected static function checkLength($data): bool
    {
        if (static::$varLength) {
            if (strlen($data) <= static::$length) {
                return true;
            }
        } else {
            if (strlen($data) == static::$length) {
                return true;
            }
        }
        return false;
    }

    protected static function checkAllowed($data)
    {
        if(static::$allowed!==null)
        {
            return in_array($data, static::$allowed);
        }else{
            return true;
        }
    }

    public static function toEdifact($tree,$depth)
    {
        return $tree[1];
    }
    public static function name(){
        return static::$name;
    }
    public static function getName()
    {
        return static::$name;
    }
}