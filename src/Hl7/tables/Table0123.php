<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:21
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0123 extends Table
{
    protected static $name='Administrative Sex';
    protected static $table=[
        "O"=>"Order received; specimen not yet received",
        "I"=>"No results available; specimen received, procedure incomplete",
        "S"=>"No results available; procedure scheduled, but not done",
        "A"=>"Some, but not all, results available",
        "P"=>"Preliminary: A verified early result is available, final results not yet obtained",
        "C"=>"Correction to results",
        "R"=>"Results stored; not yet verified",
        "F"=>"Final results; results stored and verified.  Can only be changed with a corrected result.",
        "X"=>"No results available; Order canceled.",
        "Y"=>"No order on record for this test.  (Used only on queries)",
        "Z"=>"No record of this patient. (Used only on queries)",
    ];
}