<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 21-12-2018
 * Time: 11:54
 *
 * 0429: Production class Code
 */

namespace mmerlijn\msg\src\Hl7\tables;

class Table0429 extends Table
{
    protected static $name="Production class Code";
    protected static $table = [
        'BR' => 'Breeding/genetic stock'
        , 'DA' => 'Dairy'
        , 'DR' => 'Draft'
        , 'DU' => 'Dual Purpose'
        , 'LY' => 'Layer, Includes Multiplier flocks'
        , 'MT' => 'Meat'
        , 'OT' => 'Other'
        , 'PL' => 'Pleasure'
        , 'RA' => 'Racing'
        , 'SH' => 'Show'
        , 'NA' => 'Not Applicable'
        , 'U' => 'Unknown'
    ];

}