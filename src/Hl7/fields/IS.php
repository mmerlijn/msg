<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 12:15
 */

namespace mmerlijn\msg\src\Hl7\fields;

//Coded value for user-defined tables
class IS extends Field
{
    protected static $name = 'IS';
    //No validation needed, is already done in Table...
}