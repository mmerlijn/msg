<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 21:46
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0339 extends Table
{
    protected static $name='Advanced Beneficiary Notice Code';
    protected static $table=[
        "1"=>"Service is subject to medical necessity procedures",
        "2"=>"Patient has been informed of responsibility, and agrees to pay for service",
        "3"=>"Patient has been informed of responsibility, and asks that the payer be billed",
        "4"=>"Advanced Beneficiary Notice has not been signed",
    ];
}