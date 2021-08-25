<?php


namespace mmerlijn\msg\src\Edifact32\fields;

//Code list qualifier
class F1131 extends Field
{
    protected static $name = '1131';
    protected static $type = "an";
    protected static $length = 17;
    protected static $varLength=true;
    protected static $allowed=['AMB','BIZ','CGP','CI','CLB','CMS','IC9','IC10','ICP','MAT','MF','PCL','ZZ','ZZZ'];
}