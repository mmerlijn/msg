<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 21-12-2018
 * Time: 11:54
 *
0105: Source of comment
*/
namespace mmerlijn\msg\src\Hl7\tables;

class Table0445 extends Table
{
    protected static $name="Identity Reliability Code";
    protected static $table =[
        'US'=>'Unknown/Default Social Security Number'
        ,'UD'=>'Unknown/Default Date of Birth'
        ,'UA'=>'Unknown/Default Address'
        ,'AL'=>'Patient/Person Name is an Alias'


        //private substitution
        ,'NNNLD'=>'National Person Identifier NLD'
        ];

}