<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 20:32
 */

namespace mmerlijn\msg\src\Hl7\fields;

use mmerlijn\msg\src\Hl7\tools\EncodingChars;

trait parentFieldTrait
{


    //Build an filled in HL7 tree
    public static function setFilled(string $data, string $seg, bool $component = false, bool $validate = false)
    {
        //var_dump($data);
        //var_dump($seg);
        //var_dump($component);
        //var_dump($validate);
        $filled = [0 => static::class];
        foreach (static::$structure as $i => $element) {
            $name = $seg . "[$i]";
            $subData = [0 => static::$name];
            //check if it's a component with subcomponents
            $subData = array_merge($subData, explode($component ? EncodingChars::getSubComponentSeparator() : EncodingChars::getComponentSeparator(), $data));
            //validation
            if (isset($subData[$i]) AND $validate) {
                if (strlen($subData[$i]) > $element['length']) {
                    throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: string length too long got ' . strlen($subData[$i]) . ' expects length of <=' . $element['length']);
                }
                if (isset($element['table']) AND strlen($subData[$i])) {
                    if (!$element['table']::validate($subData[$i])) {
                        throw new \Exception('Data in ' . $name . ' (' . $element['name'] . ') error: ' . $subData[$i] . ' not in table ' . $element['table']);
                    }
                }
            }
            if (isset($subData[$i])) {
                $filled[$i] = $element['class']::setFilled($subData[$i], $name, true, $validate);
            } else {
                //validation
                if ($element['opt'] == 'R' AND $validate) {
                    throw new \Exception('Data in ' . $name . ' [' . $element['class']::name() . '][' . $i . '] (' . $element['name'] . ') error: segment is required.');
                }
                $filled[$i] = $element['class']::setEmpty($name, true);
            }

        }

        return $filled;
    }

    //maakt een lege HL7 tree
    public static function setEmpty($component = false)
    {
        $empty = [0 => static::class];
        foreach (static::$structure as $i => $element) {
            //$name = $seg;
            $empty[$i] = $element['class']::setEmpty( $component);
        }
        return $empty;
    }

    public static function toHl7($tree, $depth = 2)
    {
        $hl7 = [];
        if (is_array($tree)) {
            foreach ($tree as $k => $item) {
                if ($k == 0) {
                    continue;
                }
                $hl7[] = static::$structure[$k]['class']::toHl7($item, $depth + 1);
            }
        } else {
            //var_dump($tree);
        }
        return rtrim(implode(EncodingChars::getEncodingChar($depth), $hl7), EncodingChars::getEncodingChar($depth));
    }

    public static function getData($tree, array $depthElement)
    {

    }
}