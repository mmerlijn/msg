<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 10:23
 */

namespace mmerlijn\msg\src\Hl7\fields;

use mmerlijn\msg\src\Hl7\exceptions\ValidationException;

class SI extends Field
{
    protected static $name = 'SI';

    public static function setFilled(string $data, string $seg, bool $component = false, bool $validate = false)
    {
        if (!is_numeric($data)) {
            throw new ValidationException('Data in ' . $seg . '.' . $fieldNr . '.' . $componentNr . ' (NM) error: integer value is expected got ' . $data);
        }
        return (int)$data;
    }
}