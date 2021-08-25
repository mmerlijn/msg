<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\Edifact;
use mmerlijn\msg\src\Edifact\tools\EncodingChars;

class Segment
{
    protected static $segmentCounter=['TXT'=>1,'BEP'=>1,'ARA'=>1,'OPB'=>1];
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

    public function resetSegmentCounter(){
        static::$segmentCounter=['TXT'=>1,'BEP'=>1,'ARA'=>1,'OPB'=>1];
    }
    //maakt een lege HL7 tree
    public static function setEmpty()
    {
        $empty = [0 => static::class];
        foreach (static::$structure as $i => $element) {
            $empty[$i] = $element['class']::setEmpty($i);
        }
        return [$empty];
    }

    //maakt een gevulde HL7 tree
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
                $filled[$i] = $element['class']::setEmpty();
            }
        }
        return $filled;
    }

    public static function toEdifact($tree, $depth = 1)
    {
        if(in_array(static::getName(),array_keys(static::$segmentCounter)) && Edifact::$useEdifactSegmentCounter){
            $edi = [static::getName().":".static::$segmentCounter[static::getName()]];
            static::$segmentCounter[static::getName()]++;
        }else{
            $edi = [static::getName()];
        }

        foreach ($tree as $k => $field) {
            if (!$k) {
                continue;
            }
            //static::runBeforeToHl7($k, $field);
            //var_dump($tree[0]);
            $edi[] = static::$structure[$k]['class']::toEdifact($field, $depth + 1);
        }

        return rtrim(implode(EncodingChars::getDataElementSeparator(), $edi), EncodingChars::getDataElementSeparator());
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