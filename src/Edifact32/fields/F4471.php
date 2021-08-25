<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Settlement, coded
class F4471 extends Field
{
    protected static $name = '4471';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['00','10','40','60','90','99'];

    // 00 niet verzekerd   10 Particulier   40 AWBZ   60 Ziekenfonds   90 Nota aan derden   99 Onbekend
}