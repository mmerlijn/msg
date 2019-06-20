<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 21-12-2018
 * Time: 11:54
 *

*/
namespace mmerlijn\msg\src\Hl7\tables;

class Table0189 extends Table
{
    protected static $name="Ethnic group";

    protected static $table =[
        'H'=>'Hispanic or Latino'
        ,'N'=>'Not Hispanic or Latino'
        ,'U'=>'Unknown'
        ];

}