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
    protected $structure = [
        'MSH' => MSH::class,
    ];
    //MUST be set by child
    protected $allowedSegments = [
        'MSH' => MSH::class,
        'PID' => PID::class,
    ];
    //collection of al HL7 lines
    protected $segments = [];
    protected $messageType = 'ORM';
    protected $version = '2.4';
    protected $sendingApplication = '';
    protected $receivingApplication = '';
    protected $dateTimeFormat = "Y-m-d H:i:s";
    public $dateTimeFormatOut = "YmdHisO";
    //HL7 tree structure
    //tree [Segment] [Field] [Repeat] [Component] [SubComponent]
    //public $tree = [];
    protected $tree = [];

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
        $this->readHeader($this->segments[0], $validate);

        //loop through all input message segments
        foreach ($this->segments as $i => $segment) {
            if ($i == 0) { //skip MSH
                continue;
            }
            $segmentName = substr($segment, 0, 3);
            if (key_exists($segmentName, $this->allowedSegments)) {
                $SEG = $this->allowedSegments[$segmentName];
            } else {
                throw new \Exception('ERROR segment ' . $segmentName . ' is not presented in allowed segments ' . implode(", ", array_keys($this->allowedSegments)));
            }
            //$this->tree[] = $SEG::setFilled($segment);
            $this->tree[] = $SEG::setFilled($segment);
        }
    }

    public function getTree()
    {
        return $this->tree;
    }

    public function dumpTree()
    {
        var_dump($this->tree);
    }

    public function reset()
    {
        $this->tree = [];
        $this->messageType = 'ORM';
        $this->version = '2.4';
        $this->sendingApplication = '';
        $this->receivingApplication = '';
    }

    /** Convert HL7tree to msg string
     * @param array $hl7tree
     * @return string
     */
    public function write(): string
    {

        $msg = "";
        foreach ($this->tree as $tree) {
            $msg .= $tree[0]::toHl7($tree) . chr(13); //carriage return
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
        $this->segments = preg_split("/\r\n|\n|\r/", trim($msg));
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
        $this->tree[0] = MSH::setFilled($string, $validate);

        //static::$receivingApplication = $this->tree[0][5][0][1];
        //static::$version = $this->tree[0][12][0][1];
        //static::$messageType = $this->tree[0][9][0][1];
        //static::$sendingApplication = $this->tree[0][3][0][1];

        $this->receivingApplication = $this->tree[0][5][0][1];
        $this->version = $this->tree[0][12][0][1];
        $this->messageType = $this->tree[0][9][0][1];
        $this->sendingApplication = $this->tree[0][3][0][1];

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
            if (isset($this->tree[$segmentNr][$fieldNr][$repeat][$componentNr][$subComponentNr])) {
                return $this->tree[$segmentNr][$fieldNr][$repeat][$componentNr][$subComponentNr];
            } else {
                return null;
            }
        } elseif ($componentNr) {
            if (isset($this->tree[$segmentNr][$fieldNr][$repeat][$componentNr])) {
                return $this->tree[$segmentNr][$fieldNr][$repeat][$componentNr];
            } else {
                return null;
            }
        } else {
            if (isset($this->tree[$segmentNr][$fieldNr][$repeat])) {
                return $this->tree[$segmentNr][$fieldNr][$repeat];
            } else {
                return null;
            }
        }
    }

    protected function setValue($data, int $segmentNr, int $fieldNr, int $componentNr = 0, int $subComponentNr = 0, int $repeat = 0): void
    {
        try{
            $data.="";
        }catch(\Exception $e){
            throw new \Exception("HL7::SetValue expects string/int ".gettype($data)." given");
        }
        if ($subComponentNr) {
            $this->tree[$segmentNr][$fieldNr][$repeat][$componentNr][$subComponentNr] = $data;
        } elseif ($componentNr) {
            $this->tree[$segmentNr][$fieldNr][$repeat][$componentNr] = $data;
        } else {
            $this->tree[$segmentNr][$fieldNr][$repeat] = $data;
        }
    }

    //add to repeated fields, and returns the id
    protected function addRepeatField(int $segmentNr, int $fieldNr): int
    {
        //check if repeat is possible
        if ($this->tree[$segmentNr][0]::isRepeatable($fieldNr)) {
            $this->tree[$segmentNr][$fieldNr][] = $this->tree[$segmentNr][$fieldNr][0][0]::setEmpty();
        } else {
            throw new \Exception($this->tree[$segmentNr][0][0] . ' field ' . $fieldNr . ' could not repeated');
        }
        return count($this->tree[$segmentNr][$fieldNr]) - 1;
    }

    /** gets the index number form the tree for a given segment. For example: PID -> 1 m ORC -> [10,15,20]
     * @param string $segment
     * @param bool $first
     * @return mixed
     */
    protected function getSegmentNrs(string $segment, $first = false, $createIfNotExist = false)
    {
        $segmentNrs = [];
        foreach ($this->tree as $i => $leave) {
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
                    $nr = count($this->tree);
                } else {
                    $nr = $this->getSegmentNrs($newSegment, true);
                }
            } while ($nr === false);
        } else {
            $nr = $position;
        }
        array_splice($this->tree, $nr, 0, $this->allowedSegments[$segment]::setEmpty());
        return $nr;
    }

    public function getNextAllowedSegment($segment)
    {
        if (in_array($segment, array_keys($this->allowedSegments))) {
            $nextSegment = null;
            foreach (array_reverse($this->allowedSegments) as $allowedSegment => $class) {
                if ($allowedSegment == $segment) {
                    return $nextSegment;
                }
                $nextSegment = $allowedSegment;
            }
        } else {
            throw new \Exception("Segment " . $segment . " is not present in allowed segments: " . implode(", ", array_keys($this->allowedSegments)));
        }
        return false;
    }


    protected function ifNextSegmentIs(int $currentNr, string $segment): bool
    {
        if (isset($this->tree[$currentNr + 1])) {
            if ($segment == $this->tree[$currentNr + 1][0]::name()) {
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

        $aMatch = [];
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

    protected function split_buildingnr(string $nr)
    {
        $aMatch = [];
        $pattern = '#^([0-9]{1,5})(.*)$#';
        $matchResult = preg_match($pattern, $nr, $aMatch);
        if($matchResult){
            return [
                'number'=>trim($aMatch[1]," -/"),
                'addition'=>trim($aMatch[2]," -"),
                'full'=>$aMatch[0]
            ];
        }
        return false;

    }


}