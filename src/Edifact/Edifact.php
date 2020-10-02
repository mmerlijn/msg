<?php


namespace mmerlijn\msg\src\Edifact;


use mmerlijn\msg\src\Edifact\segments\AFD;
use mmerlijn\msg\src\Edifact\segments\ARA;
use mmerlijn\msg\src\Edifact\segments\ART;
use mmerlijn\msg\src\Edifact\segments\BEP;
use mmerlijn\msg\src\Edifact\segments\DET;
use mmerlijn\msg\src\Edifact\segments\GGA;
use mmerlijn\msg\src\Edifact\segments\GGO;
use mmerlijn\msg\src\Edifact\segments\IDE;
use mmerlijn\msg\src\Edifact\segments\NUB;
use mmerlijn\msg\src\Edifact\segments\OPB;
use mmerlijn\msg\src\Edifact\segments\PAD;
use mmerlijn\msg\src\Edifact\segments\PID;
use mmerlijn\msg\src\Edifact\segments\TXT;
use mmerlijn\msg\src\Edifact\segments\UNA;
use mmerlijn\msg\src\Edifact\segments\UNB;
use mmerlijn\msg\src\Edifact\segments\UNH;
use mmerlijn\msg\src\Edifact\segments\UNT;
use mmerlijn\msg\src\Edifact\segments\UNZ;
use mmerlijn\msg\src\Edifact\segments\ZKH;
use mmerlijn\msg\src\Edifact\tools\EncodingChars;
use mmerlijn\msg\src\Edifact\traits\getHeaderTrait;
use mmerlijn\msg\src\Edifact\traits\getOrdersTrait;
use mmerlijn\msg\src\Edifact\traits\getPatientTrait;

class Edifact
{
    use getPatientTrait,getOrdersTrait,getHeaderTrait;

    public $structure = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'GGA' => GGA::class,
        'ZKH' => ZKH::class,
        'DET' => DET::class,
        'PID' => PID::class,
        'PAD' => PAD::class,
        'ART' => ART::class,
        'AFD' => AFD::class,
        'ARA' => ARA::class,
        'IDE' => IDE::class,
        'BEP' => BEP::class,
        'OPB' => OPB::class,
        'TXT' => TXT::class,
        'NUB' => NUB::class,
        'GGO' => GGO::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,


    ];
    //will be overwritten by message source/type
    public $allowedSegments = [
        'UNA' => UNA::class,
        'UNB' => UNB::class,
        'UNH' => UNH::class,
        'GGA' => GGA::class,
        'ZKH' => ZKH::class,
        'DET' => DET::class,
        'PID' => PID::class,
        'PAD' => PAD::class,
        'ART' => ART::class,
        'AFD' => AFD::class,
        'ARA' => ARA::class,
        'IDE' => IDE::class,
        'BEP' => BEP::class,
        'OPB' => OPB::class,
        'TXT' => TXT::class,
        'NUB' => NUB::class,
        'GGO' => GGO::class,
        'UNT' => UNT::class,
        'UNZ' => UNZ::class,
    ];

    //collection of al HL7 lines
    protected $segments = [];
    protected $messageType = 'MEDLAB';
    protected $version = '1';
    protected $sendingApplication = '';
    protected $receivingApplication = '';
    protected $dateTimeFormat = "Y-m-d H:i:s";

    protected $tree = [];

    public function __construct()
    {
    }

    public function read(string $edifact, bool $validate = false): void
    {
        $this->reset();

        //split message in segment strings, and drop it into static::$segments
        $this->buildSegments($edifact);

        //read first line (header UNB) and set header params
        $this->readHeader($this->segments[0]);

        $this->readMessageType($this->segments[1]);

        foreach ($this->segments as $i => $segment) {
            $segmentName = substr($segment, 0, 3);
            if (key_exists($segmentName, $this->allowedSegments)) {
                $SEG = $this->allowedSegments[$segmentName];
            } else {
                throw new \Exception('ERROR segement ' . $segmentName . ' is not presented in allowed segments ' . implode(", ", array_keys($this->allowedSegments)));
            }
            $this->tree[] = $SEG::setFilled($segment);
        }
    }
    public function reset()
    {
        $this->tree = [];
    }
    protected function buildSegments(string $msg): void
    {
        $this->segments = preg_split("/(?<!\?)'/", trim($msg));
        foreach ($this->segments as $k => $segment) {
            $this->segments[$k] = trim($segment);
            if (!strlen(trim($this->segments[$k]))) {
                unset($this->segments[$k]);
            }
        }
        //static::dumpSegments();
    }

    protected function readHeader(string $string): void
    {
        // The first segment should be the control segment
        if (preg_match('/^(UNA)+(.)(.)(.)(.)(.)(.)/', $string, $matches)) {
            array_splice($matches, 0, 2);
            EncodingChars::setSeparator($matches);
            //throw new \Exception('MSH header is not valid expect MSH|^~\&| or something like that got ' . substr($string, 0, 9));
        } else {
            EncodingChars::setSeparator();
        }
    }

    public function readMessageType(string $string): void
    {
        $unh = UNH::setFilled($string);
        $this->messageType = $unh[2][1][1];
        $this->version = $unh[2][1][1];
        switch ($this->messageType) {
            case "MEDLAB":
                $medlab = new MEDLAB();
                $this->allowedSegments = $medlab->allowedSegments;
                $this->structure = $medlab->structure;
                break;
            case "MEDVRI":
                $medvri = new MEDVRI();
                $this->allowedSegments = $medvri->allowedSegments;
                $this->structure = $medvri->structure;
                break;
            default:
                throw new \Exception('Message type ' . $this->messageType . ' is not implemented');

        }

    }

    public function dumpTree()
    {
        var_dump($this->tree);
    }

    public function dumpSegments()
    {
        var_dump($this->segments);
    }

    public function getValue(int $segmentNr, int $fieldNr, $componentNr = 0)
    {
        if ($componentNr) {
            if (isset($this->tree[$segmentNr][$fieldNr][$componentNr][1])) {
                return $this->tree[$segmentNr][$fieldNr][$componentNr][1];
            } else {
                return null;
            }
        } else {
            if (isset($this->tree[$segmentNr][$fieldNr][1])) {
                return $this->tree[$segmentNr][$fieldNr][1];
            } else {
                return null;
            }
        }
    }

    protected function getSegmentNrs(string $segment, $first = false, $createIfNotExist = false)
    {
        $segmentNrs = [];
        foreach ($this->tree as $i => $leave) {
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
            return false;
            //if ($createIfNotExist) {
            //    return $this->createSegment($segment);
            //} else {
            //    return false;
            //}

        }
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
}