<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 12:11
 */

namespace mmerlijn\msg\src\Hl7\fields;

//Coded values for HL7 tables
class ID extends Field
{
    protected static $name = 'ID';
    //No validation needed, is already done in Table...
}