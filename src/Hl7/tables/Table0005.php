<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 21-12-2018
 * Time: 11:54
 *
 * 0105: Source of comment
 */

namespace mmerlijn\msg\src\Hl7\tables;

class Table0005 extends Table
{
    protected static $name="Race";
    protected static $table = [
        '1002-5' => 'American Indian or Alaska Native'
        , '2028-9' => 'Asian'
        , '2054-5' => 'Black or African American'
        , '2076-8' => 'Native Hawaiian or Other Pacific Islander'
        , '2106-3' => 'White'
        , '2131-1' => 'Other Race'
    ];

}