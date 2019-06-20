<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 11:12
 */

namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0300;
use mmerlijn\msg\src\Hl7\tables\Table0301;

class HD extends Field
{
    use parentFieldTrait;
    protected static $name = 'HD';
    private static $structure = [
        1 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'table' => Table0300::class, 'name' => 'Namespace Id'],
        2 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Universal Id'],
        3 => ['class' => ID::class, 'length' => 6, 'opt' => 'O', 'table' => Table0301::class, 'name' => 'Universal Id Type'],

    ];


}