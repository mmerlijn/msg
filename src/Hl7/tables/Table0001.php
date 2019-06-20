<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 29-1-2019
 * Time: 22:52
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0001 extends Table
{
    protected static $name='Administrative Sex';
    protected static $table=[
        'F'=>'Female'
        ,'M'=>'Male'
        ,'O'=>'Other'
        ,'U'=>'Unknown'
        ,'A'=>'Ambiguous'
        ,'N'=>'Not applicable'
    ];
}