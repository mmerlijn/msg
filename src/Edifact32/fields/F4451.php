<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Text subject qualifier
class F4451 extends Field
{
    protected static $name = '4451';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['BEP','MAT','MAW','MVS','NUB','UIT','XF'];

    // BEP Bepalingsgegevens
    //   MA E-mail adres
    //   MAT Description of material   MAW Medische antwoord(en)
    //   MVS Medische vraagstelling   NUB Opmerkingen bij "nog uit te voeren bepaling(en)"   UIT Uitslaggegevens   XF X.400 address
}