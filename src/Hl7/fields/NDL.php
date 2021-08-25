<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:10
 */

namespace mmerlijn\msg\src\Hl7\fields;


class NDL extends Field
{
    use parentFieldTrait;
    protected static $name = 'NLD';
    protected static $structure = [
        1 => ['class' => CNN::class, 'length' => 406, 'opt' => 'O', 'name' => 'Name'],
        2 => ['class' => TS::class, 'length' => 26, 'opt' => 'O', 'name' => 'Start Date/Time'],
        3 => ['class' => TS::class, 'length' => 26, 'opt' => 'O', 'name' => 'End Date/Time'],
        4 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Point Of Care'],
        5 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Room'],
        6 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Bed'],
        7 => ['class' => HD::class, 'length' => 227, 'opt' => 'O', 'name' => 'Facility'],
        8 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Location Status'],
        9 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Patient Location Type'],
        10 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Building'],
        11 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Floor'],

    ];
}