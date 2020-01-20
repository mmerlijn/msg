<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 10:18
 */

namespace mmerlijn\msg\src\Hl7;

use mmerlijn\msg\src\Hl7\segments\MSH;
use mmerlijn\msg\src\Hl7\segments\PID;
use mmerlijn\msg\src\Hl7\tools\EncodingChars;
use mysql_xdevapi\Exception;


/**
 * Class HL7
 * @package Hl7
 */
class HL7
{
    //can be overwritten by child, default set by messageType, is for building new messages
    protected static $structure = [
        'MSH' => MSH::class,
    ];
    //MUST be set by child
    protected static $allowedSegments = [
        'MSH' => MSH::class,
        'PID' => PID::class,
    ];
    //collection of al HL7 lines
    protected static $segments = [];
    protected static $messageType = 'ORM';
    protected static $version = '2.4';
    protected static $sendingApplication = '';
    protected static $receivingApplication = '';
    protected $dateTimeFormat = "Y-m-d H:i:s";
    public $dateTimeFormatOut = "YmdHisO";
    //HL7 tree structure
    //tree [Segment] [Field] [Repeat] [Component] [SubComponent]
    //public $tree = [];
    protected static $tree = [];

    public function __construct()
    {
    }


    /** Read HL7 message string and build a tree
     * @param string $hl7string
     * @param bool $validate
     * @throws \Exception
     */
    public function read(string $hl7string, bool $validate = false): void
    {
        $this->reset();

        //split message in segment strings, and drop it into static::$segments
        $this->buildSegments($hl7string);

        //read first line (header MSH) and set header params
        $this->readHeader(static::$segments[0], $validate);

        //loop through all input message segments
        foreach (static::$segments as $i => $segment) {
            if ($i == 0) { //skip MSH
                continue;
            }
            $segmentName = substr($segment, 0, 3);
            if (key_exists($segmentName, static::$allowedSegments)) {
                $SEG = static::$allowedSegments[$segmentName];
            } else {
                throw new \Exception('ERROR segment ' . $segmentName . ' is not presented in allowed segments ' . implode(", ", array_keys(static::$allowedSegments)));
            }
            //$this->tree[] = $SEG::setFilled($segment);
            static::$tree[] = $SEG::setFilled($segment);
        }
    }

    public static function getTree()
    {
        return static::$tree;
    }

    public static function dumpTree()
    {
        var_dump(static::$tree);
    }

    public function reset()
    {
        static::$tree = [];
        static::$messageType = 'ORM';
        static::$version = '2.4';
        static::$sendingApplication = '';
        static::$receivingApplication = '';
    }

    /** Convert HL7tree to msg string
     * @param array $hl7tree
     * @return string
     */
    public function write(): string
    {

        $msg = "";
        foreach (static::$tree as $tree) {
            $msg .= $tree[0]::toHl7($tree) . "\n";
        }
        return $msg;
    }

    /**
     * @param string $msg Raw hl7 message string
     */
    protected function buildSegments(string $msg): void
    {
        //static::$segments = preg_split('/$\R?^/m', $msg);
        //if (count(static::$segments) < 2) {
        static::$segments = preg_split("/\r\n|\n|\r/", trim($msg));
        //}
    }

    /**
     * @param string $string Raw HL7 MSH string
     * @throws \Exception
     */
    protected function readHeader(string $string, bool $validate = true): void
    {
        // The first segment should be the control segment
        if (!preg_match('/^(MSH)+(.)(.)(.)(.)(.)(.)/', $string, $matches)) {
            throw new \Exception('MSH header is not valid expect MSH|^~\&| or something like that got ' . substr($string, 0, 9));
        }
        array_splice($matches, 0, 2);
        EncodingChars::setSeparator($matches);

        //$this->tree[0] = MSH::setFilled($string, true);
        static::$tree[0] = MSH::setFilled($string, $validate);

        //static::$receivingApplication = $this->tree[0][5][0][1];
        //static::$version = $this->tree[0][12][0][1];
        //static::$messageType = $this->tree[0][9][0][1];
        //static::$sendingApplication = $this->tree[0][3][0][1];

        static::$receivingApplication = static::$tree[0][5][0][1];
        static::$version = static::$tree[0][12][0][1];
        static::$messageType = static::$tree[0][9][0][1];
        static::$sendingApplication = static::$tree[0][3][0][1];

    }

    /** Helper method for easy getting values from the HL7 tree
     * @param $segmentNr
     * @param $fieldNr
     * @param int $componentNr
     * @param int $subComponentNr
     * @param int $repeat
     * @return mixed
     */
    public function getValue($segmentNr, $fieldNr, $componentNr = 0, $subComponentNr = 0, $repeat = 0)
    {
        if ($subComponentNr) {
            if (isset(static::$tree[$segmentNr][$fieldNr][$repeat][$componentNr][$subComponentNr])) {
                return static::$tree[$segmentNr][$fieldNr][$repeat][$componentNr][$subComponentNr];
            } else {
                return null;
            }
        } elseif ($componentNr) {
            if (isset(static::$tree[$segmentNr][$fieldNr][$repeat][$componentNr])) {
                return static::$tree[$segmentNr][$fieldNr][$repeat][$componentNr];
            } else {
                return null;
            }
        } else {
            if (isset(static::$tree[$segmentNr][$fieldNr][$repeat])) {
                return static::$tree[$segmentNr][$fieldNr][$repeat];
            } else {
                return null;
            }
        }
    }

    protected function setValue(string $data, int $segmentNr, int $fieldNr, int $componentNr = 0, int $subComponentNr = 0, int $repeat = 0): void
    {

        if ($subComponentNr) {
            static::$tree[$segmentNr][$fieldNr][$repeat][$componentNr][$subComponentNr] = $data;
        } elseif ($componentNr) {
            static::$tree[$segmentNr][$fieldNr][$repeat][$componentNr] = $data;
        } else {
            static::$tree[$segmentNr][$fieldNr][$repeat] = $data;
        }
    }

    //add to repeated fields, and returns the id
    protected function addRepeatField(int $segmentNr, int $fieldNr): int
    {
        //check if repeat is possible
        if (static::$tree[$segmentNr][0]::isRepeatable($fieldNr)) {
            static::$tree[$segmentNr][$fieldNr][] = static::$tree[$segmentNr][$fieldNr][0][0]::setEmpty();
        } else {
            throw new \Exception(static::$tree[$segmentNr][0][0] . ' field ' . $fieldNr . ' could not repeated');
        }
        return count(static::$tree[$segmentNr][$fieldNr]) - 1;
    }

    /** gets the index number form the tree for a given segment. For example: PID -> 1 m ORC -> [10,15,20]
     * @param string $segment
     * @param bool $first
     * @return mixed
     */
    protected function getSegmentNrs(string $segment, $first = false, $createIfNotExist = false)
    {
        $segmentNrs = [];
        foreach (static::$tree as $i => $leave) {
            if (empty($leave)) {
                throw new \Exception("Leave is empty");
            }


            if ($leave[0]::name() == $segment) {
                $segmentNrs[] = $i;
                if ($first) {
                    return $segmentNrs[0];
                }
            }
        }
        if (is_array($segmentNrs) and count($segmentNrs)) {
            return $segmentNrs;
        } else {
            if ($createIfNotExist) {
                return $this->createSegment($segment);
            } else {
                return false;
            }

        }
    }

    protected function createSegment($segment, $position = false): int
    {
        if (!$position) {
            $newSegment = $segment;
            do {
                $newSegment = $this->getNextAllowedSegment($newSegment);
                if ($newSegment === null) {
                    $nr = count(static::$tree);
                } else {
                    $nr = $this->getSegmentNrs($newSegment, true);
                }
            } while ($nr === false);
        } else {
            $nr = $position;
        }
        array_splice(static::$tree, $nr, 0, static::$allowedSegments[$segment]::setEmpty());
        return $nr;
    }

    public function getNextAllowedSegment($segment)
    {
        if (in_array($segment, array_keys(static::$allowedSegments))) {
            $nextSegment = null;
            foreach (array_reverse(static::$allowedSegments) as $allowedSegment => $class) {
                if ($allowedSegment == $segment) {
                    return $nextSegment;
                }
                $nextSegment = $allowedSegment;
            }
        } else {
            throw new \Exception("Segment " . $segment . " is not present in allowed segments: " . implode(", ", array_keys(static::$allowedSegments)));
        }
        return false;
    }


    protected function ifNextSegmentIs(int $currentNr, string $segment): bool
    {
        if (isset(static::$tree[$currentNr + 1])) {
            if ($segment == static::$tree[$currentNr + 1][0]::name()) {
                return true;
            }
        }
        return false;
    }

    public function setDatetimeFormat($datetime, $segment, $nr)
    {
        if ($datetime) {
            switch (strlen($datetime)) {
                case 14:
                    $format = "YmdHis";
                    break;
                case 12:
                    $format = "YmdHi";
                    break;
                case 19:
                    $format = "YmdHisO";
                    break;
                case 8:
                    $format = "Ymd";
                    break;
                default:
                    throw new \Exception("ERROR {$segment}.{$nr}.1 datetime format, given {$datetime}");
            }
            return $datetime ? date_create_from_format($format, $datetime)->format($this->dateTimeFormat) : "";
        }
        return '';
    }

    public function setField($value, string $segment, int $fieldNr, int $componentNr = 0, int $subComponentNr = 0, bool $first = false): void
    {
        $nrs = $this->getSegmentNrs($segment, $first);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, $fieldNr, $componentNr, $subComponentNr);
        }
    }

    public function getField(string $segment, int $fieldNr, int $componentNr = 0, int $subComponentNr = 0, $repeat = 0, array $params = ['first' => true, 'nr' => false])
    {

        $nrsSegment = $this->getSegmentNrs($segment);
        if (!is_array($nrsSegment)) {
            $nrsSegment = [];
        }
        if (count($nrsSegment)) {
            if ($params['nr'] ?? false !== false) {
                if (count($nrsSegment) > $params['nr']) {
                    return $this->getValue($nrsSegment[$params['nr']], $fieldNr, $componentNr, $subComponentNr, $repeat);
                } else {
                    return false;
                }
            } elseif ($params['first'] ?? true) {
                return $this->getValue($nrsSegment[0], $fieldNr, $componentNr, $subComponentNr, $repeat);
            } else {
                $data = [];
                foreach ($nrsSegment as $nr) {
                    $data[] = $this->getValue($nr, $fieldNr, $componentNr, $subComponentNr, $repeat);
                }
                return $data;
            }
        }
        return false;
    }

    protected function split_address($streetStr)
    {

        $aMatch = array();
        $pattern = '#^([\w[:punct:] ]+) ([0-9 ]{1,5})([\w[:punct:]\-/]*)$#';
        $matchResult = preg_match($pattern, $streetStr, $aMatch);

        $street = trim($aMatch[1] ?? false ? $aMatch[1] : '');
        $number = trim($aMatch[2] ?? false ? $aMatch[2] : '');
        $numberAddition = trim($aMatch[3] ?? false ? $aMatch[3] : '');
        if (!$matchResult) {
            $street = $streetStr;
        }

        return array('street' => $street, 'number' => $number, 'numberAddition' => $numberAddition);

    }

}