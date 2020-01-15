<?php
require "vendor/autoload.php";
$e = new mmerlijn\msg\src\Edifact32\Edifact();

$string3="MSH|^~\&|ZorgDomein||OrderManager||20191127095237+0100||ORM^O01^ORM_O01|125d1cf547c656b38d7|P|2.4|||||NLD|8859/1
PID|1||190406732^^^NLMINBIZA^NNNLD~ZD62181198^^^ZorgDomein^VN|SCH2301193401^^^SALT^PI|Schoon - Hollenberg&&Schoon&&Hollenberg^J^M^^^^L||19340123|F|||S pauwelslaan&S pauwelslaan 3&3^^Akersloot^^1921AX^NL^M||\T\^PRN^PH~0251-310182^PRN^PH||||||||||||||||||Y|NNNLD
PV1|1|O|||||||||||||||||||||||||||||||||||||||||||||||||V
PV2|||LABEDG001^laboratorium^99zda
IN1|1|^null|3311^^^VEKTIS^UZOVI|Zilveren kruis||||||||||||||||||||||||||||||||168001071
ORC|NW|ZD62181198|856565|ZD62181198|||^^^^^R||20191121161634+0100|^Broekman-Peetoom^IM||01023047^Markvoort^M.M.^^^^^^VEKTIS|^^^Groepspraktijk Akersloot&01051020^^^^^Groepspraktijk Akersloot||||01051020^Groepspraktijk Akersloot^VEKTIS||||Groepspraktijk Akersloot^^01051020^^^VEKTIS
OBR|1|ZD62181198||PROBNP^BNP (NT-pro-BNP)^99zdl|||20191127093300+0100|20191127093600+0100|2^buis|15500^Andrea^Myrthe|L|||||01023047^Markvoort^M.M.^^^^^^VEKTIS|0251-312309
OBX|1|ST|ZZ^gewenste afnamedatum^99zdl||20191127||||||F
OBX|2|ST|YY^opmerking thuisprikken^99zdl||kwetsbare oudere||||||F
OBX|3|ST|AF1^afnamelocatie^99zda||HUIS||||||F
OBX|4|ST|AF3^patient nuchter^99zda||true||||||F
OBX|5|ST|TP1^uitwisseling gegevens met arts/zorgverlener^99zda||false||||||F
ORC|NW|ZD62181198|856565|ZD62181198|||^^^^^R||20191121161634+0100|^Broekman-Peetoom^IM||01023047^Markvoort^M.M.^^^^^^VEKTIS|^^^Groepspraktijk Akersloot&01051020^^^^^Groepspraktijk Akersloot||||01051020^Groepspraktijk Akersloot^VEKTIS||||Groepspraktijk Akersloot^^01051020^^^VEKTIS
OBR|2|ZD62181198||K7^Natrium/Kalium^99zdl|||20191127093300+0100|20191127093600+0100|2^buis|15500^Andrea^Myrthe|L|||||01023047^Markvoort^M.M.^^^^^^VEKTIS|0251-312309
OBX|1|ST|ZZ^gewenste afnamedatum^99zdl||20191127||||||F
OBX|2|ST|YY^opmerking thuisprikken^99zdl||kwetsbare oudere||||||F
OBX|3|ST|AF1^afnamelocatie^99zda||HUIS||||||F
OBX|4|ST|AF3^patient nuchter^99zda||true||||||F
OBX|5|ST|TP1^uitwisseling gegevens met arts/zorgverlener^99zda||false||||||F
ORC|NW|ZD62181198|856565|ZD62181198|||^^^^^R||20191121161634+0100|^Broekman-Peetoom^IM||01023047^Markvoort^M.M.^^^^^^VEKTIS|^^^Groepspraktijk Akersloot&01051020^^^^^Groepspraktijk Akersloot||||01051020^Groepspraktijk Akersloot^VEKTIS||||Groepspraktijk Akersloot^^01051020^^^VEKTIS
OBR|3|ZD62181198||KREA^Kreatinine (serum) (eGFR)^99zdl|||20191127093300+0100|20191127093600+0100|2^buis|15500^Andrea^Myrthe|L|||||01023047^Markvoort^M.M.^^^^^^VEKTIS|0251-312309
OBX|1|ST|ZZ^gewenste afnamedatum^99zdl||20191127||||||F
OBX|2|ST|YY^opmerking thuisprikken^99zdl||kwetsbare oudere||||||F
OBX|3|ST|AF1^afnamelocatie^99zda||HUIS||||||F
OBX|4|ST|AF3^patient nuchter^99zda||true||||||F
OBX|5|ST|TP1^uitwisseling gegevens met arts/zorgverlener^99zda||false||||||F
ORC|NW|ZD62181198|856565|ZD62181198|||^^^^^R||20191121161634+0100|^Broekman-Peetoom^IM||01023047^Markvoort^M.M.^^^^^^VEKTIS|^^^Groepspraktijk Akersloot&01051020^^^^^Groepspraktijk Akersloot||||01051020^Groepspraktijk Akersloot^VEKTIS||||Groepspraktijk Akersloot^^01051020^^^VEKTIS
OBR|4|ZD62181198||NUCHTER^NUCHTER^99zdl|||20191127093300+0100|20191127093600+0100|2^buis|15500^Andrea^Myrthe|L|||||01023047^Markvoort^M.M.^^^^^^VEKTIS|0251-312309
";

$string4="MSH|^~\&|PCC^GEM 4000;07121016|KH-01|LIS|KH-01|20090924120513||ORU^R01|117725235|P|2.4|||AL|NE||8859/1
PID|1||2222||Musterfrau^Eva||19550210|F||||||||||||||||||
PV1|1||32||||||||||||||||082222|||||||||||||||||||||||||||||||
ORC|1||||CM||||||||
OBR|1|||Elektrolyte|||20080225142233|20080225142233|||N|||20181230000000|BLDA||||||||||||^^^20080225142233^^R|||||||
NTE|1|D|Repeated measurement|
OBX|1|NM|Ca++^Ca++||1.14|mmol/L|1.17-1.37|N|||F|||20080225142233||||07121016|20080225142233
OBX|2|NM|Glu^Glu||193|mg/dL|55.0-100.0|N|||F|||20080225142233||||07121016|20080225142233
OBX|3|NM|Hct^Hct||28|%|36.0-50.0|N|||F|||20080225142233||||07121016|20080225142233
OBX|4|NM|K+^K+||3.2|mmol/L|3.6-4.8|N|||F|||20080225142233||||07121016|20080225142233
OBX|5|NM|Lac^Lac||11.4|mmol/L|1.0-1.8|N|||F|||20080225142233||||07121016|20080225142233
OBX|6|NM|Na+^Na+||141|mmol/L|135.0-144.0||||F|||20080225142233||||07121016|20080225142233
OBX|7|NM|pCO2^pCO2||41|mmHg|32.0-46.0||||F|||20080225142233||||07121016|20080225142233
NTE|1|D|Clot detected|
OBX|8|NM|pH^pH||7.15||7.37-7.45|N|||F|||20080225142233||||07121016|20080225142233
OBX|9|NM|pO2^pO2||70|mmHg|71.0-104.0|N|||F|||20080225142233||||07121016|20080225142233
OBX|10|NM|^THb||9.8|g/dL|12.3-17.5|N|||F|||20080225142233||||07121016|20080225142233
";
echo $string3;
echo "\n\n";
$h = new \mmerlijn\msg\src\Hl7\HL7ZorgdomeinAanvraag();
$h->read($string4);

$H = $h->getHeader();
$O = $h->getOrders();
$P = $h->getPatient();


$O->labnr = "041234";
$O->labnr = "012345";

$e->setHeader($H,$O,$P);

echo $e->write();
//$e::dumpTree();

var_dump($O);