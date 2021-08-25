<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 11:07
 */

namespace mmerlijn\msg\src\Hl7\fields;

//ST: String Data

use mmerlijn\msg\src\Hl7\tools\EncodingChars;

class ST extends Field
{
    protected static $name = 'ST';

    //no validation needed
    public static function setFilled(string $data, string $seg, bool $component = false, bool $validate = false)
    {
        return EncodingChars::decode($data);
    }

    public static function toHl7($tree, $depth)
    {
        if($tree)
            return EncodingChars::encode($tree);
        else
            return "";
    }
}