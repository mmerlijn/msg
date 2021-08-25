<?php

namespace mmerlijn\msg\tests;

use mmerlijn\msg\src\Edifact\Edifact;
use mmerlijn\msg\src\repo\Header;
use PHPUnit\Framework\TestCase;

class EdifactHeaderTest extends TestCase
{
    private $edi;

    protected function setUp(): void
    {
        $this->edi = new Edifact();
    }

    public function test_get_header(){
        $edifact= "UNB+UNOA:1+50001111+50002222+201201:1401+SNM1020'
UNH+1020+MEDVRI:1'
GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'
DET+21:06:08+15:32'
PID+1980:10:25+V+Berg:van de:Jansen:::P.++BSN123456782'
TXT:1+Hello World'
GGO+Arts Lastname+++Old street:3b::Amsterdam:'
UNT+7+1020'
UNZ+1+1020'
";
        $this->edi->read($edifact);
        $header = $this->edi->getHeader();

        $this->assertSame('50001111',$header->sending_facility);
        $this->assertSame('50002222',$header->receiving_facility);
        $this->assertSame('2020-12-01 14:01:00',$header->datetime_of_message);
        $this->assertSame('SNM1020',$header->message_control_id);
        $this->assertSame('MEDVRI',$header->message_type_type);
        $this->assertSame('Organisation name',$header->sender['name']);
        $this->assertSame('Fill work',$header->sender['department']);
        $this->assertSame('New Street',$header->sender['street']);
        $this->assertSame('12',$header->sender['buildingnr']);
        $this->assertSame('Amsterdam',$header->sender['city']);
        $this->assertSame('1000AA',$header->sender['postcode']);
        $this->assertSame('+31612341234',$header->sender['phone']);
        //$this->edi->dumpTree();

    }
    public function test_set_medvri_header()
    {
        $header = new Header();
        $header->sending_facility="50001111";
        $header->receiving_facility="50002222";
        $header->datetime_of_message ="2020-12-01 14:01:02";
        $header->message_type_structure="UNOA";
        $header->message_type_type="MEDVRI";
        $header->message_control_id = '1020';
        $header->sender['agbcode'] ="50001111";
        $header->sender['name'] = "Organisation name";
        $header->sender['department'] = "Fill work";
        $header->sender['street'] = "New Street";
        $header->sender['buildingnr'] = 12;
        $header->sender['city'] = "Amsterdam";
        $header->sender['postcode'] = "1000AA";
        $header->sender['phone'] = "+31612341234";

        $header->receiver['name'] = "Arts name";
        $header->receiver['city'] = "Amsterdam";
        $header->receiver['street'] = "Green street";
        $header->receiver['buildingnr'] = "33A";
        $header->receiver['postcode'] = "1000BB";
        $header->receiver['phone'] = "0201231234";
        $this->edi->setHeader($header);
        //$this->edi->dumpTree();
        $now = date_create();
        $this->assertSame("UNB+UNOA:1+50001111+50002222+201201:1401+SNM1020'".chr(13).
            "UNH+1020+MEDVRI:1'".chr(13).
            "GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'".chr(13).
"DET+".$now->format('y').":".$now->format('m').":".$now->format('d')."+".$now->format('H').":".$now->format('i')."'".chr(13).
            "GGO+Arts name+++Green street:33A::Amsterdam:1000BB+0201231234'".chr(13).
            "UNT+5+1020'".chr(13).
"UNZ+1+1020'".chr(13),
            $this->edi->write());
    }
}
