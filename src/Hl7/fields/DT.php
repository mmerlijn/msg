<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 12:12
 */

namespace mmerlijn\msg\src\Hl7\fields;

//Date
use mmerlijn\msg\src\Hl7\exceptions\ValidationException;

class DT extends Field
{
    protected static $name = 'DT';

    public static function setFilled(string $data, string $seg, bool $component = false, bool $validate = false)
    {
        //Specifies the century and year with optional precision to month and day.
        if (!preg_match('/\d{4}(\d{2})?(\d{2})?/', $data)) {
            throw new ValidationException('Data in ' . $seg . '.' . $fieldNr . '.' . $componentNr . ' (DT) error: Date expected YYYY(MM)(DD) got ' . $data);
        }
        return $data;
    }
}