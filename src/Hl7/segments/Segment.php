<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 10:20
 */

namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\tools\EncodingChars;

class Segment
{
    protected static $name = "UNDEFINED";
    protected static $structure = [];

    public static function getName()
    {
        return static::$name;
    }

    public static function name()
    {
        return static::$name;
    }

    //maakt een lege HL7 tree
    public static function setEmpty()
    {
        $empty = [0 => static::class];
        foreach (static::$structure as $i => $element) {
            $empty[$i] = [$element['class']::setEmpty($i)];
        }
        return [$empty];
    }

    //maakt een gevulde HL7 tree
    public static function setFilled(string $data, bool $validate = false)
    {
        $filled = [0 => static::class];
        //Split string to array
        $fields = explode(EncodingChars::getFieldSeparator(), $data);

        if (static::$name == 'MSH') { //MSH is a little bit different form other segments
            array_splice($fields, 1, 0, substr($data, 3, 1));
            //array_splice($fields, 2, 0, substr($data, 4, 4));
        }
        static::runBeforeSetFilled($fields);
        //loop through the structure of the segment
        foreach (static::$structure as $i => $element) {
            $name = static::getName() . "[$i]";
            //validation
            if (isset($fields[$i]) AND $validate) {
                if (strlen($fields[$i]) > $element['length']) {
                    throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: string length too long got ' . strlen($fields[$i]) . ' expects length of <=' . $element['length']);
                }
                if (isset($element['table']) AND strlen($fields[$i])) {
                    if (!$element['table']::validate($fields[$i])) {
                        throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: ' . $fields[$i] . ' not in table ' . $element['table']);
                    }
                }
            }
            //if ($element['rpt'] === true) {
            if ($fields[$i] ?? false) {
                if (static::$name != 'MSH' AND $i != 2) {
                    $parts = explode(EncodingChars::getRepetitionSeparator(), $fields[$i]);
                    foreach ($parts as $j => $part) {
                        if ($part) {
                            $filled[$i][] = $element['class']::setFilled($part, $name, false, $validate);
                        } elseif ($j == 0) {
                            $filled[$i] = [$element['class']::setEmpty($i)];
                        }
                    }
                } else {
                    $filled[$i][] = $element['class']::setFilled($fields[$i], $name, false, $validate);
                }
            } else {
                //validation for required fields
                if ($element['opt'] == 'R' AND $validate) {
                    throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: segment is required');
                }
                $filled[$i] = [$element['class']::setEmpty($i)];
            }
        }
        return $filled;
    }

    public static function toHl7($tree, $depth = 1)
    {
        $hl7 = [static::getName()];
        foreach ($tree as $k => $field) {
            if ((static::name() == 'MSH' AND $k == 1) OR !$k) {    //exception for MSH.1
                continue;
            }
            $_hl7 = [];
            //static::runBeforeToHl7($k, $field);
            if (is_array($field[0])) {
                foreach ($field as $i => $rptField) {
                    static::runBeforeToHl7($i, $rptField);
                    //var_dump($rptField);
                    //var_dump($field[0]);
                    $_hl7[] = $rptField[0]::toHl7($rptField, $depth + 1);
                }
            } else {
                //var_dump($tree[0]);
                static::runBeforeToHl7($k, $field);
                $_hl7[] = static::$structure[$k]['class']::toHl7($field[0], $depth + 1);
            }
            $hl7[] = implode(EncodingChars::getRepetitionSeparator(), $_hl7);
        }

        return rtrim(implode(EncodingChars::getFieldSeparator(), $hl7), EncodingChars::getFieldSeparator());
    }

    public static function isRepeatable($field)
    {
        return static::$structure[$field]['rpt'];
    }

    protected static function runBeforeSetFilled($fields)
    {

    }

    protected static function runBeforeToHl7($segmentWithNr, $dataTree)
    {
    }

}