<?php


namespace mmerlijn\msg\src\Edifact32\segments;


use mmerlijn\msg\src\Edifact32\tools\EncodingChars;

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

    //maakt een lege Edifact tree
    public static function setEmpty()
    {
        $empty = [0 => static::class];
        foreach (static::$structure as $i => $element) {
            $empty[$i] = $element['class']::setEmpty($i);
        }
        return [$empty];
    }

    //maakt een gevulde Edifact tree
    public static function setFilled(string $data, bool $validate = false)
    {
        $filled = [0 => static::class];
        //Split string to array
        $pattern = '/('.EncodingChars::getReleaseCharacter().'<!\?)\\'.EncodingChars::getDataElementSeparator().'/';
        $fields = preg_split($pattern, $data);
        //$fields = explode(EncodingChars::getDataElementSeparator(), $data);

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

    public static function toEdifact($tree, $depth = 1)
    {
        $edifact = [static::getName()];
        foreach ($tree as $k => $field) {
            if(!$k){
                continue;
            }
            $edifact[] = static::$structure[$k]['class']::toEdifact($field, $depth + 1);

        }

        return rtrim(implode(EncodingChars::getEncodingChar($depth), $edifact), EncodingChars::getEncodingChar($depth));
    }


    protected static function runBeforeSetFilled($fields)
    {

    }

    protected static function runBeforeToEdifact($segmentWithNr, $dataTree)
    {
    }
}