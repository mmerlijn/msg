<?php


namespace mmerlijn\msg\src\Edifact32;


use mmerlijn\msg\src\Edifact32\segments\ADR;

use mmerlijn\msg\src\Edifact32\segments\COM;
use mmerlijn\msg\src\Edifact32\segments\CTA;

use mmerlijn\msg\src\Edifact32\segments\DTM;
use mmerlijn\msg\src\Edifact32\segments\FTX;

use mmerlijn\msg\src\Edifact32\segments\INV;
use mmerlijn\msg\src\Edifact32\segments\NAD;

use mmerlijn\msg\src\Edifact32\segments\PDI;

use mmerlijn\msg\src\Edifact32\segments\PNA;
use mmerlijn\msg\src\Edifact32\segments\RFF;
use mmerlijn\msg\src\Edifact32\segments\RND;
use mmerlijn\msg\src\Edifact32\segments\RSL;
use mmerlijn\msg\src\Edifact32\segments\S01;
use mmerlijn\msg\src\Edifact32\segments\S02;
use mmerlijn\msg\src\Edifact32\segments\S03;
use mmerlijn\msg\src\Edifact32\segments\S04;
use mmerlijn\msg\src\Edifact32\segments\S06;
use mmerlijn\msg\src\Edifact32\segments\S07;
use mmerlijn\msg\src\Edifact32\segments\S16;
use mmerlijn\msg\src\Edifact32\segments\S18;
use mmerlijn\msg\src\Edifact32\segments\S20;
use mmerlijn\msg\src\Edifact32\segments\SPC;
use mmerlijn\msg\src\Edifact32\segments\STS;

use mmerlijn\msg\src\Edifact32\segments\UNA;
use mmerlijn\msg\src\Edifact32\segments\UNB;
use mmerlijn\msg\src\Edifact32\segments\UNH;
use mmerlijn\msg\src\Edifact32\segments\UNT;
use mmerlijn\msg\src\Edifact32\segments\UNZ;

use mmerlijn\msg\src\Edifact32\tools\EncodingChars;
use mmerlijn\msg\src\Edifact32\segments\BGM;
use mmerlijn\msg\src\Edifact32\traits\SetHeaderTrait;
use mmerlijn\msg\src\Edifact32\traits\SetOrdersTrait;
use mmerlijn\msg\src\Edifact32\traits\SetPatientTrait;

class Edifact
{
    use SetPatientTrait,SetOrdersTrait,SetHeaderTrait;

    public static $structure = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,


    ];
    //will be overwritten by message source/type
    public static $allowedSegments = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'BGM'=>BGM::class,
        'DTM'=>DTM::class,
        'S01'=>S01::class,
        'NAD'=>NAD::class,
        'ADR'=>ADR::class,
        'COM'=>COM::class,
        'CTA'=>CTA::class,
        'S02'=>S02::class,
        'RFF'=>RFF::class,
        'STS'=>STS::class,
        'S03'=>S03::class,
        'S04'=>S04::class,
        'S06'=>S06::class,
        'S07'=>S07::class,
        'PNA'=>PNA::class,
        'PDI'=>PDI::class,
        'S16'=>S16::class,
        'SPC'=>SPC::class,
        'S18'=>S18::class,
        'INV'=>INV::class,
        'RSL'=>RSL::class,
        'FTX'=>FTX::class,
        'S20'=>S20::class,
        'RND'=>RND::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,
    ];

    //collection of al HL7 lines
    protected static $segments = [];
    protected static $messageType = 'MEDLAB';
    protected static $version = '1';
    protected static $sendingApplication = '';
    protected static $receivingApplication = '';
    protected $dateTimeFormat = "Y-m-d H:i:s";

    protected static $tree = [];

    public function __construct()
    {
    }

    public function reset()
    {
        static::$tree = [];
    }
    protected function buildSegments(string $msg): void
    {
        static::$segments = preg_split("/(?<!\?)'/", trim($msg));
        foreach (static::$segments as $k => $segment) {
            static::$segments[$k] = trim($segment);
            if (!strlen(trim(static::$segments[$k]))) {
                unset(static::$segments[$k]);
            }
        }
        //static::dumpSegments();
    }

    public static function dumpTree()
    {
        var_dump(static::$tree);
    }

    public static function dumpSegments()
    {
        var_dump(static::$segments);
    }

    /** Convert HL7tree to msg string
     * @param array $hl7tree
     * @return string
     */
    public function write(): string
    {

        $msg = "";
        foreach (static::$tree as $tree) {
            $msg .= $tree[0]::toEdifact($tree) . "'\n";
        }
        return $msg;
    }

    protected function setValue(string $data, int $segmentNr, int $fieldNr, int $componentNr = 0): void
    {
        if ($componentNr) {
            static::$tree[$segmentNr][$fieldNr][$componentNr][1] = $data;
        } else {
            static::$tree[$segmentNr][$fieldNr][1] = $data;
        }
    }


    public function getValue(int $segmentNr, int $fieldNr, $componentNr = 0)
    {
        if ($componentNr) {
            if (isset(static::$tree[$segmentNr][$fieldNr][$componentNr][1])) {
                return static::$tree[$segmentNr][$fieldNr][$componentNr][1];
            } else {
                return null;
            }
        } else {
            if (isset(static::$tree[$segmentNr][$fieldNr][1])) {
                return static::$tree[$segmentNr][$fieldNr][1];
            } else {
                return null;
            }
        }
    }

    protected function getSegmentNrs(string $segment, $first = false, $createIfNotExist = false)
    {
        $segmentNrs = [];
        foreach (static::$tree as $i => $leave) {
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
            //return false;
            if ($createIfNotExist){
                return $this->createSegment($segment);
            } else {
                return false;
            }

        }
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

    protected function createSegment($segment, $position = false): int
    {
        if ($position===false) {
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
            if($position=="last" or $position=="end"){
                $nr = count(static::$tree);
            }else{
                $nr = $position;
            }
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
    public function setDatetimeFormat($datetime,$segment,$nr)
    {
        if($datetime) {
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
    public function setField($value,string $segment,int $fieldNr, int $componentNr = 0,bool $first=false):void
    {
        $nrs = $this->getSegmentNrs($segment, $first);
        if (!is_array($nrs)) {
            $nrs = [$nrs];
        }
        foreach ($nrs as $nr) {
            $this->setValue($value, $nr, $fieldNr,$componentNr);
        }
    }
    public function getField(string $segment,int $fieldNr, int $componentNr=0,array $params=['first'=>true,'nr'=>false])
    {

        $nrsSegment = $this->getSegmentNrs($segment);
        if (!is_array($nrsSegment)) {
            $nrsSegment = [];
        }
        if (count($nrsSegment)) {
            if ($params['nr']??false !== false) {
                if (count($nrsSegment) > $params['nr']) {
                    return $this->getValue($nrsSegment[$params['nr']], $fieldNr, $componentNr);
                } else {
                    return false;
                }
            } elseif ($params['first']??true) {
                return $this->getValue($nrsSegment[0], $fieldNr, $componentNr);
            } else {
                $data = [];
                foreach ($nrsSegment as $nr) {
                    $data[] = $this->getValue($nr, $fieldNr, $componentNr);
                }
                return $data;
            }
        }
        return false;
    }
}