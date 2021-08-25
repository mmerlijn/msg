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
use mmerlijn\msg\src\Edifact\segments\Segment;
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
use mmerlijn\msg\src\Edifact\traits\setHeaderTrait;
use mmerlijn\msg\src\Edifact\traits\setOrdersTrait;
use mmerlijn\msg\src\Edifact\traits\setPatientTrait;

class Edifact
{
    use getPatientTrait,getOrdersTrait,getHeaderTrait,setHeaderTrait,setPatientTrait,setOrdersTrait;

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
    public static $useEdifactSegmentCounter=false; //example TXT:1+...

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

    public function write(): string
    {
        $this->setLineCount();
        $this->resetSegmentCounter();
        $msg = "";
        foreach ($this->tree as $tree) {
            $msg .= $tree[0]::toEdifact($tree) . EncodingChars::getSegmentTerminator().chr(13); //carriage return
        }
        return $msg;
    }
    private function resetSegmentCounter(){
        $s = new Segment();
        $s->resetSegmentCounter();
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
                throw new \Exception('Message type ' . $this->messageType . ' is not implemented / UNH does not exists');

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
                return EncodingChars::decode($this->tree[$segmentNr][$fieldNr][$componentNr][1]);
            } else {
                return null;
            }
        } else {
            if (isset($this->tree[$segmentNr][$fieldNr][1])) {
                return EncodingChars::decode($this->tree[$segmentNr][$fieldNr][1]);
            } else {
                return null;
            }
        }
    }
    protected function setValue($data, int $segmentNr, int $fieldNr, int $componentNr = 0): void
    {
        try{
            $data.="";
        }catch(\Exception $e){
            throw new \Exception("HL7::SetValue expects string/int ".gettype($data)." given");
        }
        if ($componentNr) {

            if(is_array($this->tree[$segmentNr][$fieldNr][$componentNr])){
                $this->tree[$segmentNr][$fieldNr][$componentNr][1] = $data; //EncodingChars::encode();
            }else{
                $this->tree[$segmentNr][$fieldNr][$componentNr] = $data; //EncodingChars::encode();
            }

        } else {
            $this->tree[$segmentNr][$fieldNr][1] = $data; //EncodingChars::encode($data);
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
            //return false;
            if ($createIfNotExist) {
                return $this->createSegment($segment);
            } else {
                return false;
            }

        }
    }
    public function createSegment($segment, $position = false): int
    {
        if (!$position) {
            $newSegment = $segment;
            $nr = $this->getNewSegmentPosition($newSegment);
                if ($nr === false) {
                    $nr = -1;
                }
        } else {
            $nr = $position;
        }
        //echo $nr."-".$segment.PHP_EOL;
        array_splice($this->tree, $nr+1, 0, $this->allowedSegments[$segment]::setEmpty());
        return $nr+1;
    }
    public function getNewSegmentPosition($segment)
    {
        if (in_array($segment, array_keys($this->allowedSegments))) {
            $position = $this->segmentExists($segment);
            if($position!==false){
                return $position;
            }else{
                $try=false;
                foreach (array_reverse($this->structure) as $segName=>$segClass){
                    if(!$try and $segName == $segment){
                        $try=true;
                        continue;
                    }
                    if($try){
                        $position = $this->segmentExists($segName);
                        if($position!==false){
                            return $position;
                        }
                    }
                }
                return false;
                //get position off segment of allowed segments
            }
        } else {
            throw new \Exception("Segment " . $segment . " is not present in allowed segments: " . implode(", ", array_keys($this->allowedSegments)));
        }
    }
    //return key off last existing segment, else false
    public function segmentExists($segment)
    {
        $found=false;
        foreach ($this->tree as $k=>$treeItem){
            if($treeItem[0]::getName() == $segment){
                $found= $k;
            }
        }
        return $found;
    }
    public function getNextAllowedSegment($segment)
    {
        if (in_array($segment, array_keys($this->allowedSegments))) {
            $nextSegment = null;
            foreach (array_reverse($this->allowedSegments) as $allowedSegment => $class) {
                //var_dump($allowedSegment,$class);
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
    private function setLineCount()
    {
        $nr = $this->getSegmentNrs('UNT',true);
        if($nr){
            $this->setValue(count($this->tree)-2, $nr, 1,1);
        }

    }
    public function setUseEdifactSegmentCounter(){
        static::$useEdifactSegmentCounter=true;
    }
}