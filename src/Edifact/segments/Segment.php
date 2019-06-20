<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\tools\EncodingChars;

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
    //public static function setEmpty()
    //{
    //    $empty = [0 => static::class];
    //    foreach (static::$structure as $i => $element) {
    //        $empty[$i] = [$element['class']::setEmpty($i)];
    //    }
    //    return [$empty];
    //}

    //maakt een gevulde HL7 tree
    public static function setFilled(string $data, bool $validate = false)
    {
        $filled = [0 => static::class];
        //Split string to array
        $fields = explode(EncodingChars::getDataElementSeparator(), $data);

        //static::runBeforeSetFilled($fields);
        //loop through the structure of the segment
        foreach (static::$structure as $i => $element) {
            $name = static::getName() . "[$i]";
            //validation
            if (isset($fields[$i]) AND $validate) {
                if (strlen($fields[$i]) == 0 AND $element['opt'] == "M") {
                    throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: value is required ' . strlen($fields[$i]));
                }
                //    if (strlen($fields[$i]) > $element['length']) {
                //        throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: string length too long got ' . strlen($fields[$i]) . ' expects length of <=' . $element['length']);
                //    }
                //    if (isset($element['table']) AND strlen($fields[$i])) {
                //        if (!$element['table']::validate($fields[$i])) {
                //            throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: ' . $fields[$i] . ' not in table ' . $element['table']);
                //        }
                //    }
            }

            if ($fields[$i] ?? false) {
                $filled[$i] = $element['class']::setFilled($fields[$i], $name, $validate);
            } else {
                $filled[$i] = [$element['class']::setEmpty()];
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