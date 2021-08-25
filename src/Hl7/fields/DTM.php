<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 16:44
 */

namespace mmerlijn\msg\src\Hl7\fields;


class DTM extends Field
{
    protected static $name = 'DTM';

    public static function setFilled(string $data, string $seg, bool $component = false, bool $validate = false)
    {
        if ($data) {
            if (!($dt = \DateTime::createFromFormat('YmdHisO', $data) !== false)) {
                if (!($dt = \DateTime::createFromFormat('YmdHi', $data) !== false)) {
                    if (!($dt = \DateTime::createFromFormat('YmdHis', $data) !== false)) {
                        if (!($dt = \DateTime::createFromFormat('Ymd', $data) !== false)) {
                            throw new \Exception('Data in ' . $seg . ' (DTM) error: TIME expected YYYYMMDD(his) got ' . $data);
                        }
                    }
                }
            }

        }
        return $data;
    }
}