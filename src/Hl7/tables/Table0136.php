<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 21-12-2018
 * Time: 11:54
 *
*/
namespace mmerlijn\msg\src\Hl7\tables;

class Table0136 extends Table
{
    protected static $name="Yes/no indicator";
    protected static $table =[
        'Y'=>'Yes'
        ,'N'=>'No'
        ];

}