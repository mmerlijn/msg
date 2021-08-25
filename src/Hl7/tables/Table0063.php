<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:36
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0063 extends Table
{
    protected static $name = 'Relationship';
    protected static $table = [
        "SEL" => "Self",
        "SPO" => "Spouse",
        "DOM" => "Life partner",
        "CHD" => "Child",
        "GCH" => "Grandchild",
        "NCH" => "Natural child",
        "SCH" => "Stepchild",
        "FCH" => "Foster child",
        "DEP" => "Handicapped dependent",
        "WRD" => "Ward of court",
        "PAR" => "Parent",
        "MTH" => "Mother",
        "FTH" => "Father",
        "CGV" => "Care giver",
        "GRD" => "Guardian",
        "GRP" => "Grandparent",
        "EXF" => "Extended family",
        "SIB" => "Sibling",
        "BRO" => "Brother",
        "SIS" => "Sister",
        "FND" => "Friend",
        "OAD" => "Other adult",
        "EME" => "Employee",
        "EMR" => "Employer",
        "ASC" => "Associate",
        "EMC" => "Emergency contact",
        "OWN" => "Owner",
        "TRA" => "Trainer",
        "MGR" => "Manager",
        "NON" => "None",
        "UNK" => "Unknown",
        "OTH" => "Other",
    ];

}

