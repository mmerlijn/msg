<?php
require "vendor/autoload.php";
$poct = "MSH|^~\&|Meditrac^POCTAF2.002|POCcelerator|||20200910162549||ORU^R01|457342247|P|2.4|||AL|NE||8859/1
PID|1||ZD72903108^^^^^||^^^^|||U|||^^^^^|||||||||||||||
PV1|1||02^^^||||||||||||||||^^|||||||||||||||||||||||||||||||
OBR|1|||External parameter^^^^^|||20200910162209|20200910162209|||N|||20200910162209|||||||||^||||^^^20200910162209^^R|||||||
OBX|1|ST|POCT_CRP^CRP^^||<5|mg/L|||||F|||20200910162209||013||20011887|20200910162209
";
$aanvraag="MSH|^~\&|ZorgDomein||OrderModule||20200910160608+0200||ORM^O01^ORM_O01|2d6bf7ec9f9b4828bba1|P|2.4|||||NLD|8859/1
PID|1||189076161^^^NLMINBIZA^NNNLD~ZD72903108^^^ZorgDomein^VN||Duindam&&Duindam^Y^^^^^L||19871222|M|||Top Naeffstraat 34&Top Naeffstraat&34^^ZAANDAM^^1507XX^NL^M||0613345003^ORN^CP||||||||||||||||||Y|NNNLD
PV1|1|O|||||||||||||||||||||||||||||||||||||||||||||||||V
PV2|||LABEDG001^laboratorium^99zda
IN1|1|^null|0^^^LOCAL|Menzis||||||||||||||||||||||||||||||||2105495913
ORC|NW|ZD72903108||ZD72903108|||^^^^^R||20200910160543+0200|01020007^Fibbe^LA^^^^^^VEKTIS||01020007^Fibbe^LA^^^^^^VEKTIS|^^^Huisartsenpraktijk Van der Lugt en Kuschbert&01052184^^^^^Huisartsenpraktijk Van der Lugt en Kuschbert||||01052184^Huisartsenpraktijk Van der Lugt en Kuschbert^VEKTIS||||Huisartsenpraktijk Van der Lugt en Kuschbert^^01052184^^^VEKTIS
OBR|1|ZD72903108||POCT_CRP^POCT_CRP^99zdl|||||||O|||||01020007^Fibbe^LA^^^^^^VEKTIS
OBX|1|ST|COVIDSYM^Covid-19 verdacht^99zdl||true||||||F
OBX|2|CE|COVIDURG^Urgentie?^99zda||12 mnd^Binnen 12 mnd^99zda||||||F
ORC|NW|ZD72903108||ZD72903108|||^^^^^R||20200910160543+0200|01020007^Fibbe^LA^^^^^^VEKTIS||01020007^Fibbe^LA^^^^^^VEKTIS|^^^Huisartsenpraktijk Van der Lugt en Kuschbert&01052184^^^^^Huisartsenpraktijk Van der Lugt en Kuschbert||||01052184^Huisartsenpraktijk Van der Lugt en Kuschbert^VEKTIS||||Huisartsenpraktijk Van der Lugt en Kuschbert^^01052184^^^VEKTIS
OBR|2|ZD72903108||TIJD^TIJD^99zdl|||||||O|||||01020007^Fibbe^LA^^^^^^VEKTIS
";
$h_poct = new \mmerlijn\msg\src\Hl7\HL7ZorgdomeinAanvraag();
$h_poct->read($poct);
$h_aanvraag = new \mmerlijn\msg\src\Hl7\HL7ZorgdomeinAanvraag();
$h_aanvraag->read($aanvraag);

$ph=  $h_poct->getHeader();
$po = $h_poct->getOrders();

$ap = $h_aanvraag->getPatient();
$ao = $h_aanvraag->getOrders();

$po->labnr = 600010;
$po->requester = $ao->requester;
$po->requester['street'] = 'Edamstraat';
$po->requester['buildingnr'] = 61;
$po->requester['city'] = 'Zaandam';
$ph->sender['city'] = 'Koog ad Zaan';
$ph->sender['street'] = 'Molenwerf';
$ph->sender['buildingnr'] = 11;
$ph->sender['postcode'] = "1541WR";
$ph->sender['country'] = "NL";
$ph->sender['phone'] = "088 9100100";
$ph->sender['name'] = "SALT";
$ph->sender['agbcode'] = "530008";
$ph->sender['department'] = "POCT";
$ph->message_control_id=20;  //msg_id
$ph->sending_application = "530008"; //agbcode salt
$ph->receiving_application = $ao->requester['agbcode'];
//var_dump($po);
$po->request_date = $ao->request_date;


$edi = new \mmerlijn\msg\src\Edifact32\Edifact();
$edi->setHeader($ph, $po ,$ap);
echo $edi->write();