<?php


namespace mmerlijn\msg\src\Edifact\fields;


use mmerlijn\msg\src\Edifact\tools\EncodingChars;

trait ParentFieldTrait
{
    public static function setFilled(string $data, string $seg,bool $validate = false)
    {

        $filled = [0 => static::class];
        foreach (static::$structure as $i => $element) {
            $name = $seg . "[$i]";
            $subData = [0 => static::$name];
            //check if it's a component with subcomponents
            $subData = array_merge($subData, explode(EncodingChars::getComponentDataElementSeparator() , $data));
            //validation
            if (isset($subData[$i]) AND $validate) {
               //if(!static::$checkAllowed($subData[$i])){
               //    throw new \Exception('ERROR in seg '.$name.' data not allowed');
               //}
               //if (!static::$checkLength($subData[$i])) {
               //    throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: string length too long got ' . strlen($subData[$i]) . ' expects length of <=' . $element['length']);
               //}
               //if (isset($element['table']) AND strlen($subData[$i])) {
               //    if (!$element['table']::validate($subData[$i])) {
               //        throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: ' . $subData[$i] . ' not in table ' . $element['table']);
               //    }
               //}
            }
            if (isset($subData[$i])) {
                $filled[$i] = $element['class']::setFilled($subData[$i], $name, $validate);
            } else {
                //validation
                if ($element['opt'] == 'M' AND $validate) {
                    throw new \Exception('Data in ' . $name . ' [' . $element['class']::name() . '][' . $i . '] (' . $element['name'] . ') error: segment is required.');
                }
                $filled[$i] = $element['class']::setEmpty($name, true);
            }
        }
        return $filled;
    }

    public static function setEmpty()
    {
        $empty = [0 => static::class];
        foreach (static::$structure as $i => $element) {
            //$name = $seg;
            $empty[$i] = $element['class']::setEmpty();
        }
        return $empty;
    }

    public static function toEdifact($tree, $depth = 2)
    {
        $edi = [];
        if (is_array($tree)) {
            foreach ($tree as $k => $item) {
                if ($k == 0) {
                    continue;
                }
                $edi[] = static::$structure[$k]['class']::toEdifact($item, $depth + 1);
            }
        }
        return rtrim(implode(EncodingChars::getEncodingChar($depth), $edi), EncodingChars::getEncodingChar($depth));
    }
}