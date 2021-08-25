<?php


namespace mmerlijn\msg\src\Hl7\segments;


use mmerlijn\msg\src\Hl7\fields\CQ;
use mmerlijn\msg\src\Hl7\fields\CWE;
use mmerlijn\msg\src\Hl7\fields\DR;
use mmerlijn\msg\src\Hl7\fields\EIP;
use mmerlijn\msg\src\Hl7\fields\ID;
use mmerlijn\msg\src\Hl7\fields\NM;
use mmerlijn\msg\src\Hl7\fields\SI;
use mmerlijn\msg\src\Hl7\fields\ST;
use mmerlijn\msg\src\Hl7\fields\TS;
use mmerlijn\msg\src\Hl7\tables\Table0487;

class SPM extends Segment
{
    protected static $name = 'SPM';
    protected static $structure = [
        1 => ['class' =>SI::class, 'rpt' => false, 'length' => 4, 'opt' => 'O', 'name' => 'Set ID - SPM'],
        2 => ['class' => EIP::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Specimen ID'],
        3 => ['class' => EIP::class, 'rpt' => false, 'length' => 80, 'opt' => 'O', 'name' => 'Specimen Parent IDs'],
        4 => ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'R', 'name' => 'Specimen Type','table'=>Table0487::class],
        5 => ['class' => CWE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Type Modifier'],
        6 => ['class' => CWE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Additives'],
        7 => ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Collection Method'],
        8 => ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Source Site'],
        9 => ['class' => CWE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Source Site Modifier'],
        10 => ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Collection Site'],
        11 => ['class' => CWE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Role'],
        12 => ['class' => CQ::class, 'rpt' => false, 'length' => 20, 'opt' => 'O', 'name' => 'Specimen Collection Amount'],
        13 => ['class' => NM::class, 'rpt' => false, 'length' => 6, 'opt' => 'C', 'name' => 'Grouped Specimen Count'],
        14=> ['class' => ST::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Description'],
        15=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Handling Code'],
        16=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Risk Code'],
        17=> ['class' => DR::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Specimen Collection Date/Time'],
        18=> ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Specimen Received Date/Time'],
        19=> ['class' => TS::class, 'rpt' => false, 'length' => 26, 'opt' => 'O', 'name' => 'Specimen Expiration Date/Time'],
        20=> ['class' => ID::class, 'rpt' => false, 'length' => 1, 'opt' => 'O', 'name' => 'Specimen Availability'],
        21=> ['class' => CWE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Reject Reason'],
        22=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Quality'],
        23=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Appropriateness'],
        24=> ['class' => CWE::class, 'rpt' => true, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Condition'],
        25=> ['class' => CQ::class, 'rpt' => false, 'length' => 20, 'opt' => 'O', 'name' => 'Specimen Current Quantity'],
        26=> ['class' => NM::class, 'rpt' => false, 'length' => 4, 'opt' => 'C', 'name' => 'Number of Specimen Containers'],
        27=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Container Type'],
        28=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Container Condition'],
        29=> ['class' => CWE::class, 'rpt' => false, 'length' => 250, 'opt' => 'O', 'name' => 'Specimen Child Role'],
    ];
}