<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:03
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0369 extends Table
{
    protected static $name='Specimen Role';
    protected static $table=[
        "B"=>"Blind Sample",
        "C"=>"Calibrator",
        "P"=>"Patient (default if blank component value)",
        "Q"=>"Control specimen",
        "R"=>"Replicate (of patient sample as a control)",
    ];
}