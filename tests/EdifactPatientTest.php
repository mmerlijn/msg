<?php

namespace mmerlijn\msg\tests;

use mmerlijn\msg\src\Edifact\Edifact;
use mmerlijn\msg\src\repo\Patient;
use PHPUnit\Framework\TestCase;

class EdifactPatientTest extends TestCase
{
    private $edi;

    protected function setUp(): void
    {
        $this->edi = new Edifact();
    }

    public function test_get_patient()
    {
        $edifact= "UNB+UNOA:1+50001111+50002222+201201:1401+1020'
UNH+1020+MEDVRI:1'
GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'
DET+21:06:08+15:32'
PID+1980:10:25+V+Berg:van de:Jansen:van::P.++BSN123456782'
PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'
TXT:1+Hello World'
TXT:2+This is a message'
GGO+Arts Lastname+++Old street:3b::Amsterdam:'
UNT+9+1020'
UNZ+1+1020'
";
        $this->edi->read($edifact);
        $patient = $this->edi->getPatient();

        $this->assertSame('1980-10-25',$patient->dob);
        $this->assertSame('F',$patient->sex);
        $this->assertSame('Berg',$patient->last_name);
        $this->assertSame('van de',$patient->last_name_prefix);
        $this->assertSame('Jansen',$patient->surname);
        $this->assertSame('van',$patient->surname_prefix);
        $this->assertSame('P',$patient->initials);
        $this->assertSame('123456782',$patient->bsn);
        $this->assertSame('Blue street',$patient->street);
        $this->assertSame('43b',$patient->building_nr_full);
        $this->assertSame('43',$patient->building_nr);
        $this->assertSame('b',$patient->building_nr_additive);
        $this->assertSame('Amsterdam',$patient->city);
        $this->assertSame('1040BB',$patient->postcode);
        $this->assertSame('+31612345678',$patient->phones[0]);

    }
    public function test_set_patient()
    {
        //Female
        $p = new Patient();
        $p->initials="K.M.";
        $p->surname_prefix="de";
        $p->surname = "Groot";
        $p->last_name_prefix = 'van \'t';
        $p->last_name="Hek";
        $p->sex="F";
        $p->bsn="123456782";
        $p->dob = "1999-09-13";

        $p->city="Amsterdam";
        $p->street="Blue street";
        $p->building_nr_full = "43b";
        $p->postcode="1040BB";
        $p->phones[] = "+31612345678";
        $this->edi->setPatient($p);
        //$this->edi->dumpTree();
        $this->assertSame(
            "PID+1999:09:13+V+Hek:van ?'t:Groot:de::KM++BSN123456782'".chr(13).
            "PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'".chr(13),
            $this->edi->write()
        );
        //Male
        $p = new Patient();
        $p->initials="K.M.";
        $p->surname_prefix="de";
        $p->surname = "Groot";
        $p->sex="M";
        $p->bsn="123456782";
        $p->dob = "1999-09-13";

        $p->city="Amsterdam";
        $p->street="Blue street";
        $p->building_nr_full = "43b";
        $p->postcode="1040BB";
        $p->phones[] = "+31612345678";
        $this->edi->setPatient($p);
        //$this->edi->dumpTree();
        $this->assertSame(
            "PID+1999:09:13+M+::Groot:de::KM++BSN123456782'".chr(13).
            "PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'".chr(13),
            $this->edi->write()
        );

    }
    public function test_to_array(){
        $edifact= "UNB+UNOA:1+50001111+50002222+201201:1401+1020'
UNH+1020+MEDVRI:1'
GGA+Organisation name+Fill work+Organisation name+New Street:12::Amsterdam:1000AA+?+31612341234'
DET+21:06:08+15:32'
PID+1980:10:25+V+Berg:van de:Jansen:van::P.++BSN123456782'
PAD+Blue street:43b::Amsterdam:1040BB+?+31612345678'
TXT:1+Hello World'
TXT:2+This is a message'
GGO+Arts Lastname+++Old street:3b::Amsterdam:'
UNT+9+1020'
UNZ+1+1020'
";
        $this->edi->read($edifact);
        $header = $this->edi->getHeader()->toArray();
        $this->assertIsArray($header);
        $patient = $this->edi->getPatient()->toArray();
        $this->assertIsArray($patient);
        $orders = $this->edi->getOrders()->toArray();
        $this->assertIsArray($orders);
    }
}
