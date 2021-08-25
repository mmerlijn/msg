<?php

namespace mmerlijn\msg\tests;

use mmerlijn\msg\src\Hl7\HL7;
use mmerlijn\msg\src\Hl7\tools\EncodingChars;
use PHPUnit\Framework\TestCase;

class HL7Test extends TestCase
{
    private $hl7; //HL7 object
    private $msg;
    protected function setUp(): void
    {
        $this->hl7 = new HL7();
        $this->msg = "MSH|^~\&|ZorgDomein||OrderManager||20180327143358+0200||ORM^O01^ORM_O01|69a0f2c151134430ad18|P|2.4|||||NLD|8859/1".chr(13).
"PID|1||900073962^^^NLMINBIZA^NNNLD~ZP10007446^^^ZorgDomein^VN||Testpatiënt - van ZorgDomein&van&ZorgDomein&&Testpatiënt^Z^D^^^^L||19901231|F|||2e Antonie Heinsiusstraat 3456 b&2e Antonie Heinsiusstraat&3456^b^'s-Gravenhage^^9999ZZ^NL^M||+31-612345678^ORN^CP~00-1-345-7654321^PRN^PH||||||||||||||||||Y|NNNLD
";
        $this->hl7->read($this->msg);
    }

    public function test_read_HL7(){

        //var_dump($hl7->getTree());
        $this->assertIsArray($this->hl7->getTree());
        $this->assertCount(2, $this->hl7->getTree());
        $this->assertSame('mmerlijn\msg\src\Hl7\segments\MSH', $this->hl7->getTree()[0][0]);
        $this->assertSame('mmerlijn\msg\src\Hl7\segments\PID', $this->hl7->getTree()[1][0]);

        $this->assertSame("|", EncodingChars::getFieldSeparator());
        $this->assertSame("^", EncodingChars::getComponentSeparator());
        $this->assertSame("~", EncodingChars::getRepetitionSeparator());
        $this->assertSame("\\", EncodingChars::getEscapeChar());
        $this->assertSame("&", EncodingChars::getSubComponentSeparator());

        $this->assertObjectHasAttribute('messageType',$this->hl7);
        $this->assertObjectHasAttribute('version',$this->hl7);
        $this->assertObjectHasAttribute('sendingApplication',$this->hl7);
        $this->assertObjectHasAttribute('receivingApplication',$this->hl7);
    }
    public function test_write_HL7(){
        $this->assertSame(trim(EncodingChars::encodeChars($this->msg)), trim($this->hl7->write()));
    }

    public function test_get_field()
    {
        $this->assertSame("ZorgDomein",$this->hl7->getField('MSH',3,1));
        $this->assertSame("OrderManager",$this->hl7->getField('MSH',5,1));
        $this->assertSame("20180327143358+0200",$this->hl7->getField('MSH',7,1));
        $this->assertSame("ORM",$this->hl7->getField('MSH',9,1));
        $this->assertSame("O01",$this->hl7->getField('MSH',9,2));
        $this->assertSame("ORM_O01",$this->hl7->getField('MSH',9,3));
        $this->assertSame("69a0f2c151134430ad18",$this->hl7->getField('MSH',10));
        $this->assertSame("P",$this->hl7->getField('MSH',11,1));
        $this->assertSame("2.4",$this->hl7->getField('MSH',12,1));
        $this->assertSame("NLD",$this->hl7->getField('MSH',17));
        $this->assertSame("8859/1",$this->hl7->getField('MSH',18));

        $this->assertSame(1,$this->hl7->getField('PID',1));
        $this->assertSame("900073962", $this->hl7->getField('PID',3,1,0,0));
        $this->assertSame("NLMINBIZA", $this->hl7->getField('PID',3,4,1,0));
        $this->assertSame("ZP10007446", $this->hl7->getField('PID',3,1,0,1));
        $this->assertSame("ZorgDomein", $this->hl7->getField('PID',3,4,1,1));
        $this->assertSame("19901231", $this->hl7->getField('PID',7,1));
        $this->assertSame("F", $this->hl7->getField('PID',8));
        $this->assertSame("2e Antonie Heinsiusstraat 3456 b", $this->hl7->getField('PID',11,1,1));
        $this->assertSame("2e Antonie Heinsiusstraat", $this->hl7->getField('PID',11,1,2));
        $this->assertSame("3456", $this->hl7->getField('PID',11,1,3));
        $this->assertSame("b", $this->hl7->getField('PID',11,2));
        $this->assertSame("'s-Gravenhage", $this->hl7->getField('PID',11,3));
        $this->assertSame("9999ZZ", $this->hl7->getField('PID',11,5));
        $this->assertSame("NL", $this->hl7->getField('PID',11,6));
        $this->assertSame("+31-612345678", $this->hl7->getField('PID',13,1));
        $this->assertSame("ORN", $this->hl7->getField('PID',13,2));
        $this->assertSame("CP", $this->hl7->getField('PID',13,3));
    }

    public function test_set_field()
    {
        $this->hl7->setField("Naam", 'PID', 5,1,3);
        $this->assertSame('Naam',$this->hl7->getField('PID', 5,1,3));

    }
}
