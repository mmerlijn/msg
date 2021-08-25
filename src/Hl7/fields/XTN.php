<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 29-1-2019
 * Time: 21:33
 */

namespace mmerlijn\msg\src\Hl7\fields;;


use mmerlijn\msg\src\Hl7\tables\Table0201;
use mmerlijn\msg\src\Hl7\tables\Table0202;

class XTN extends Field
{
    use parentFieldTrait;
    protected static $name = 'XTN';
    private static $structure = [
        1 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Telephone Number'], //
        2 => ['class' => ID::class, 'length' => 3, 'opt' => 'O', 'name' => 'Telecommunication Use Code', 'table' => Table0201::class], //
        3 => ['class' => ID::class, 'length' => 8, 'opt' => 'O', 'name' => 'Telecommunication Equipment Type', Table0202::class], //
        4 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Email Address'], //
        5 => ['class' => NM::class, 'length' => 3, 'opt' => 'O', 'name' => 'Country Code'], //
        6 => ['class' => NM::class, 'length' => 5, 'opt' => 'O', 'name' => 'Area/City Code'], //
        7 => ['class' => NM::class, 'length' => 9, 'opt' => 'O', 'name' => 'Phone Numbe'], //
        8 => ['class' => NM::class, 'length' => 5, 'opt' => 'O', 'name' => 'Extension'], //
        9 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Any Text'], //

    ];
}