<?php

namespace mmerlijn\msg\tests;

use mmerlijn\msg\src\Edifact\Edifact;
use mmerlijn\msg\src\Hl7\HL7;
use mmerlijn\msg\src\Hl7\HL7ZorgdomeinAanvraag;
use mmerlijn\msg\src\repo\Patient;
use PHPUnit\Framework\TestCase;

class EdifactPatientTest extends TestCase
{
    private $hl7;

    protected function setUp(): void
    {
        $this->hl7 = new HL7ZorgdomeinAanvraag();
        $this->msg = "MSH|^~\&|ZorgDomein||OrderManager||20180327143358+0200||ORM^O01^ORM_O01|69a0f2c151134430ad18|P|2.4|||||NLD|8859/1" . chr(13) .
            "PID|1||ZP10007446^^^ZorgDomein^VN~900073962^^^NLMINBIZA||Testpatiënt - van ZorgDomein&van&ZorgDomein&&Testpatiënt^Z^D^^^^L||19901231|F|||2e Antonie Heinsiusstraat 3456 b&2e Antonie Heinsiusstraat&3456^b^'s-Gravenhage^^9999ZZ^NL^M||+31-612345678^ORN^CP~00-1-345-7654321^PRN^PH||||||||||||||||||Y|NNNLD
";
    }

    public function test_get_patient()
    {

        $this->hl7->read($this->msg);
        $patient = $this->hl7->getPatient();

        $this->assertSame('1990-12-31', $patient->dob);
        $this->assertSame('F', $patient->sex);
        $this->assertSame('900073962', $patient->bsn);
        $this->assertSame('2e Antonie Heinsiusstraat', $patient->street);
        $this->assertSame('3456 b', $patient->building_nr_full);
        $this->assertSame('3456', $patient->building_nr);
        $this->assertSame('b', $patient->building_nr_additive);
        $this->assertSame('\'s-Gravenhage', $patient->city);
        $this->assertSame('9999ZZ', $patient->postcode);
        $this->assertSame('+31612345678', $patient->phones[0]);

    }

    public function test_set_patient_alternate_identity()
    {
        $this->hl7->read($this->msg);
        $patient = $this->hl7->getPatient();
        $patient->setIdentity('AAA12345678', 'SALT', 'PI', true);
        $this->hl7->setPatient($patient);
        $expected_out = "MSH|^~\&|ZorgDomein||OrderManager||20180327143358+0200||ORM^O01^ORM_O01|69a0f2c151134430ad18|P|2.4|||||NLD|8859/1" . chr(13) .
            "PID|1||ZP10007446^^^ZorgDomein^VN~900073962^^^NLMINBIZA^NNNLD|AAA12345678^^^SALT^PI|Testpatient - van ZorgDomein&van&ZorgDomein&&Testpatient^Z^D^^^^L||19901231|F|||2e Antonie Heinsiusstraat 3456 b&2e Antonie Heinsiusstraat&3456^b^'s-Gravenhage^^9999ZZ^NL^M||+31612345678^PNR^PH~0013457654321^PNR^PH||||||||||||||||||Y|NNNLD
";
        $this->assertSame(trim($this->hl7->write()), trim($expected_out));
    }
}
