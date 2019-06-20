<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 21-12-2018
 * Time: 11:54
 *
 * 0203: Identifier type
 */

namespace mmerlijn\msg\src\Hl7\tables;

class Table0203 extends Table
{
    public static $name = "Identifier type";
    public static $table = [
        'AM' => 'American Express'
        , 'AN' => 'Account number'
        , 'BA' => 'Bank Account Number'
        , 'BR' => 'Birth registry number'
        , 'BRN' => 'Breed Registry Number'
        , 'DI' => 'Diner’s Club card'
        , 'DL' => 'Driver’s license number'
        , 'DN' => 'Doctor number'
        , 'DR' => 'Donor Registration Number'
        , 'DS' => 'Discover Card'
        , 'EI' => 'Employee number'
        , 'EN' => 'Employer number'
        , 'FI' => 'Facility ID'
        , 'GI' => 'Guarantor internal identifier'
        , 'GN' => 'Guarantor external  identifier'
        , 'HC' => 'Health Card Number'
        , 'JHN' => 'Jurisdictional health number (Canada)'
        , 'LN' => 'License number'
        , 'LR' => 'Local Registry ID'
        , 'MA' => 'Medicaid number'
        , 'MC' => 'Medicare number'
        , 'MCN' => 'Microchip Number'
        , 'MR' => 'Medical record number'
        , 'MS' => 'MasterCard'
        , 'NE' => 'National employer identifier'
        , 'NH' => 'National Health Plan Identifier'
        , 'NI' => 'National unique individual identifier'
        //, 'NNxxx' => 'National Person Identifier where the xxx is the ISO table 3166  3-character (alphabetic) country code'
        , 'NPI' => 'National provider identifier'
        , 'PEN' => 'Pension Number'
        , 'PI' => 'Patient internal identifier'
        , 'PN' => 'Person number'
        , 'PRN' => 'Provider number'
        , 'PT' => 'Patient external identifier'
        , 'RR' => 'Railroad Retirement number'
        , 'RRI' => 'Regional registry ID'
        , 'SL' => 'State license'
        , 'SR' => 'State registry ID'
        , 'SS' => 'Social Security number'
        , 'U' => 'Unspecified'
        , 'UPIN' => 'Medicare/HCFA’s Universal Physician Identification numbers'
        , 'VN' => 'Visit number'
        , 'VS' => 'VISA'
        , 'WC' => 'WIC identifier'
        , 'WCN' => 'Workers’ Comp Number'
        , 'XX' => 'Organization identifier'
    ];

    public static function validate(string $data):bool
    {
        if (key_exists($data, static::$table)) {
            return true;
        } elseif (preg_match('/[N]{2}[A-z]{3}/', $data)) {
            return true;
        }
        return false;
    }
}