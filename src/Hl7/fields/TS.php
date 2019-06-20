<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 21:44
 */
namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0529;

class TS extends Field
{
    use parentFieldTrait;
    protected static $name = 'TS';

    private static $structure = [
        1 => ['class' => DTM::class, 'length' => 24, 'opt' => 'R', 'name' => 'Time'], //
        2 => ['class' => ID::class, 'length' => 1, 'opt' => 'B', 'name' => 'Degree Of Precision', 'table' => Table0529::class], //


    ];
}