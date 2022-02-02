<?php

namespace mmerlijn\msg\tests;

use mmerlijn\msg\src\Hl7\HL7_DFT_P03;
use mmerlijn\msg\src\Hl7\tools\EncodingChars;
use PHPUnit\Framework\TestCase;

class HL7_DFT_Test extends TestCase
{
    private $hl7; //HL7 object
    private $msg;

    protected function setUp(): void
    {
        $this->hl7 = new HL7_DFT_P03();
        $this->msg = "MSH|^~\&|glims|TestGLIMS_O_SALT_DFT|SALT_INS|TestGLIMS_O_SALT_DFT|20210922103316||DFT^P03|12345678|P|2.4|||NE|AL" . chr(13) .
            "EVN|P03|20210927101100" . chr(13) .
            "PID|1||900073962^^^NLMINBIZA^NNNLD~ZP10007446^^^ZorgDomein^VN||Testpatiënt - van ZorgDomein&van&ZorgDomein&&Testpatiënt^Z^D^^^^L||19901231|F|||2e Antonie Heinsiusstraat 3456 b&2e Antonie Heinsiusstraat&3456^b^'s-Gravenhage^^9999ZZ^NL^M||+31-612345678^ORN^CP~00-1-345-7654321^PRN^PH||||||||||||||||||Y|NNNLD" . chr(13) .
            "FT1||1234512345^ZD12345678||20210922103300|20210927101100|c|012345|||1|||KCL|||||||30000|01101010||1234512345" . chr(13) .
            "FT1||1234512345^ZD12345678||20210922103300|20210927101100|c|012346|||1|||KCL|||||||30000|01101010||1234512345" . chr(13);
        $this->hl7->read($this->msg);
    }

    public function test_read_HL7()
    {

        //var_dump($hl7->getTree());
        $this->assertIsArray($this->hl7->getTree());
        $this->assertCount(5, $this->hl7->getTree());
        $this->assertSame('mmerlijn\msg\src\Hl7\segments\MSH', $this->hl7->getTree()[0][0]);
        $this->assertSame('mmerlijn\msg\src\Hl7\segments\PID', $this->hl7->getTree()[2][0]);

        $this->assertSame("|", EncodingChars::getFieldSeparator());
        $this->assertSame("^", EncodingChars::getComponentSeparator());
        $this->assertSame("~", EncodingChars::getRepetitionSeparator());
        $this->assertSame("\\", EncodingChars::getEscapeChar());
        $this->assertSame("&", EncodingChars::getSubComponentSeparator());

        $this->assertObjectHasAttribute('messageType', $this->hl7);
        $this->assertObjectHasAttribute('version', $this->hl7);
        $this->assertObjectHasAttribute('sendingApplication', $this->hl7);
        $this->assertObjectHasAttribute('receivingApplication', $this->hl7);
    }

    public function test_write_HL7()
    {
        $this->assertSame(trim(EncodingChars::encodeChars($this->msg)), trim($this->hl7->write()));
    }

    public function test_get_field()
    {
        $this->assertSame("glims", $this->hl7->getField('MSH', 3, 1));
        $this->assertSame("SALT_INS", $this->hl7->getField('MSH', 5, 1));
        $this->assertSame("20210922103316", $this->hl7->getField('MSH', 7, 1));
        $this->assertSame("DFT", $this->hl7->getField('MSH', 9, 1));
        $this->assertSame("P03", $this->hl7->getField('MSH', 9, 2));
        $this->assertSame("12345678", $this->hl7->getField('MSH', 10));
        $this->assertSame("P", $this->hl7->getField('MSH', 11, 1));
        $this->assertSame("2.4", $this->hl7->getField('MSH', 12, 1));

        $this->assertSame(1, $this->hl7->getField('PID', 1));
        $this->assertSame("900073962", $this->hl7->getField('PID', 3, 1, 0, 0));
        $this->assertSame("NLMINBIZA", $this->hl7->getField('PID', 3, 4, 1, 0));
        $this->assertSame("ZP10007446", $this->hl7->getField('PID', 3, 1, 0, 1));
        $this->assertSame("ZorgDomein", $this->hl7->getField('PID', 3, 4, 1, 1));
        $this->assertSame("19901231", $this->hl7->getField('PID', 7, 1));
        $this->assertSame("F", $this->hl7->getField('PID', 8));
        $this->assertSame("2e Antonie Heinsiusstraat 3456 b", $this->hl7->getField('PID', 11, 1, 1));
        $this->assertSame("2e Antonie Heinsiusstraat", $this->hl7->getField('PID', 11, 1, 2));
        $this->assertSame("3456", $this->hl7->getField('PID', 11, 1, 3));
        $this->assertSame("b", $this->hl7->getField('PID', 11, 2));
        $this->assertSame("'s-Gravenhage", $this->hl7->getField('PID', 11, 3));
        $this->assertSame("9999ZZ", $this->hl7->getField('PID', 11, 5));
        $this->assertSame("NL", $this->hl7->getField('PID', 11, 6));
        $this->assertSame("+31-612345678", $this->hl7->getField('PID', 13, 1));
        $this->assertSame("ORN", $this->hl7->getField('PID', 13, 2));
        $this->assertSame("CP", $this->hl7->getField('PID', 13, 3));

        $financial = $this->hl7->getFinancial();
        $this->assertIsArray($financial->transactions);
        $this->assertSame("20210927101100", $financial->date);
        $this->assertSame("ZD12345678", $financial->requestnr);
        $this->assertSame("1234512345^ZD12345678", $financial->transactions[0]->id);
        $this->assertSame("KCL", $financial->transactions[0]->department_code);
    }

}
