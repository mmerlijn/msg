<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Priority, coded
class F4219 extends Field
{
    protected static $name = '4219';
    protected static $type = "an";
    protected static $length = 3;
    protected static $varLength=true;
    protected static $allowed=['CI','NO','PH'];
    // CI Stat (immediately) (=Cito)   NO Routine   PH Immediate answer (by use of telephone)
}