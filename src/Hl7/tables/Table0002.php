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

class Table0002 extends Table
{
    protected static $name="Marital Status";
    protected static $table =[
        'A'=>'Separated'
        ,'D'=>'Divorced'
        ,'M'=>'Married'
        ,'S'=>'Single'
        ,'W'=>'Widowed'
        ,'C'=>'Common law'
        ,'G'=>'Living together'
        ,'P'=>'Domestic partner'
        ,'R'=>'Registered domestic partner'
        ,'E'=>'Legally Separated'
        ,'N'=>'Annulled'
        ,'I'=>'Interlocutory'
        ,'B'=>'Unmarried'
        ,'U'=>'Unknown'
        ,'O'=>'Other'
        ,'T'=>'Unreported'
        ];

}