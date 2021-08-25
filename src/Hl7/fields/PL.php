<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:17
 */

namespace mmerlijn\msg\src\Hl7\fields;


class PL extends Field
{
    use parentFieldTrait;
    protected static $name = 'PL';
    private static $structure = [
        1 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Point Of Care'],
        2 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Room'],
        3 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Bed'],
        4 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Facility'],
        5 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Location Status'],
        6 => ['class' => IS::class, 'length' => 20, 'opt' => 'C', 'name' => 'Person Location Type'],
        7 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Building'],
        8 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Floor'],
        9 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Location Description'],
        10 => ['class' => EI::class, 'length' => 427, 'opt' => 'O', 'name' => 'Comprehensive Location Identifier'],
        11 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Assigning Authority For Location'],
    ];
}