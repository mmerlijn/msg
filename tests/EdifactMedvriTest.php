<?php

namespace mmerlijn\msg\tests;

use mmerlijn\msg\src\Edifact\Edifact;
use mmerlijn\msg\src\Edifact\MEDVRI;
use mmerlijn\msg\src\Edifact\tools\EncodingChars;
use mmerlijn\msg\src\repo\Header;
use mmerlijn\msg\src\repo\Order;
use mmerlijn\msg\src\repo\OrderNote;
use mmerlijn\msg\src\repo\Orders;
use mmerlijn\msg\src\repo\Patient;
use PHPUnit\Framework\TestCase;

class EdifactMedvriTest extends TestCase
{
    private $edi;

    protected function setUp(): void
    {
        $this->edi = new MEDVRI();
    }

    public function test_read_edifact()
    {
        $edifact = "UNB+UNOA:1+50001111+50002222+201201:1401+SNM1020'
UNH+1020+MEDVRI:1'
GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'
DET+21:06:08+15:32'
PID+1980:10:25+V+Berg:van de:Jansen:van::P.++BSN123456782'
PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'
TXT:1+Hello World'
TXT:2+This is a message'
TXT:3+'
TXT:3+Greetings'
GGO+Arts Lastname+++Old street:3b::Amsterdam:'
UNT+11+1020'
UNZ+1+1020'
";
        $this->edi->read($edifact);
        $h = $this->edi->getHeader();
        $p = $this->edi->getPatient();
        $o = $this->edi->getOrders();

        $this->assertSame('Blue street', $p->street);
        $this->assertSame('MEDVRI', $h->message_type_type);
        $this->assertSame('2021-06-08 15:32:00', $o->orders[0]->observation_start_time);
        $this->assertSame("Hello World" . PHP_EOL . "This is a message" . PHP_EOL . PHP_EOL . "Greetings", $o->orders[0]->notes[0]->comment);
    }

    public function test_write_edifact()
    {
        $header = new Header();
        $patient = new Patient();
        $orders = new Orders();

        $header->sending_facility = "50001111";
        $header->receiving_facility = "50002222";
        $header->datetime_of_message = "2020-12-01 14:01:02";
        $header->message_type_structure = "UNOA";
        $header->message_type_type = "MEDVRI";
        $header->message_control_id = '1020';
        $header->sender['agbcode'] = "50001111";
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

        $orders = new Orders();
        $order = new Order();
        $order->observation_start_time = "2021-06-07 12:12:00";
        $orderNote = new OrderNote();
        $orderNote->comment = "Hello World
this is a message

greetings";
        $order->addOrderNote($orderNote);
        $orders->addOrder($order);

        $patient->initials = "K.M.";
        $patient->surname_prefix = "de";
        $patient->surname = "Groot";
        $patient->last_name_prefix = 'van \'t';
        $patient->last_name = "Hek";
        $patient->sex = "F";
        $patient->bsn = "123456782";
        $patient->dob = "1999-09-13";
        $patient->city = "Amsterdam";
        $patient->street = "Blue street";
        $patient->building_nr_full = "43b";
        $patient->postcode = "1040BB";
        $patient->phones[] = "+31612345678";

        $this->edi->setUseEdifactSegmentCounter();
        $this->edi->setOrders($orders);
        $this->edi->setHeader($header);
        $this->edi->setPatient($patient);

        //$this->edi->dumpTree();
        $this->assertSame("UNB+UNOA:1+50001111+50002222+201201:1401+SNM1020'" . chr(13) .
            "UNH+1020+MEDVRI:1'" . chr(13) .
            "GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'" . chr(13) .
            "DET+21:06:07+12:12'" . chr(13) .
            "PID+1999:09:13+V+Hek:van ?'t:Groot:de::KM++BSN123456782'" . chr(13) .
            "PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'" . chr(13) .
            "TXT:1+Hello World'" . chr(13) .
            "TXT:2+this is a message'" . chr(13) .
            "TXT:3'" . chr(13) .
            "TXT:4+greetings'" . chr(13) .
            "GGO+Arts name+++Green street:33A::Amsterdam:1000BB+0201231234'" . chr(13) .
            "UNT+11+1020'" . chr(13) .
            "UNZ+1+SNM1020'" . chr(13)
            , $this->edi->write());
    }

    public function test_read_write()
    {
        $edifact = "UNB+UNOA:1+50001111+50002222+201201:1401+SNM1020'" . chr(13) .
            "UNH+1020+MEDVRI:1'" . chr(13) .
            "GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'" . chr(13) .
            "PID+1999:09:13+V+Hek:van ?'t:Groot:de::KM++BSN123456782'" . chr(13) .
            "PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'" . chr(13) .
            "TXT:1+Hello World'" . chr(13) .
            "TXT:2+this is a message'" . chr(13) .
            "TXT:3'" . chr(13) .
            "TXT:4+greetings'" . chr(13) .
            "GGO+Arts name+++Green street:33A::Amsterdam:1000BB+0201231234'" . chr(13) .
            "UNT+10+1020'" . chr(13) .
            "UNZ+1+1020'" . chr(13);
        $this->edi->read($edifact);
        $this->edi->setUseEdifactSegmentCounter();
        $this->assertSame($edifact, $this->edi->write());
    }

    public function test_read_write_no_segment_counter()
    {
        $edifact = "UNB+UNOA:1+50001111+50002222+201201:1401+SNM1020'" . chr(13) .
            "UNH+1020+MEDVRI:1'" . chr(13) .
            "GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'" . chr(13) .
            "PID+1999:09:13+V+Hek:van ?'t:Groot:de::KM++BSN123456782'" . chr(13) .
            "PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'" . chr(13) .
            "TXT:1+Hello World'" . chr(13) .
            "TXT:2+this is a message'" . chr(13) .
            "TXT:3'" . chr(13) .
            "TXT+greetings'" . chr(13) .
            "GGO+Arts name+++Green street:33A::Amsterdam:1000BB+0201231234'" . chr(13) .
            "UNT+10+1020'" . chr(13) .
            "UNZ+1+1020'" . chr(13);
        $this->edi->read($edifact);
        $this->assertSame($edifact, $this->edi->write());
    }
}
