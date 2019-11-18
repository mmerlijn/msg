<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 29-1-2019
 * Time: 21:37
 */

namespace mmerlijn\msg\src\Hl7\fields;

use mmerlijn\msg\src\Hl7\exceptions\ValidationException;

class NM extends Field
{
    protected static $name = 'NM';

    public static function setFilled(string $data, string $seg, bool $component = false, bool $validate = false)
    {
        if (!is_numeric($data) AND $data) {
            throw new ValidationException('Data in ' . $seg . '. (NM) error: numeric value is expected got ' . $data);
        }
        return $data;
    }
}