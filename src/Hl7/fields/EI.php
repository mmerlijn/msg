<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 30-1-2019
 * Time: 12:50
 */
namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0301;
use mmerlijn\msg\src\Hl7\tables\Table0363;

class EI extends Field
{
    use parentFieldTrait;
    protected static $name = 'EI';
    protected static $structure = [
        1 => ['class' => ST::class, 'length' => 199, 'opt' => 'O', 'name' => 'Entity Identifier'],
        2 => ['class' => IS::class, 'length' => 20, 'opt' => 'O', 'name' => 'Namespace Id', 'table' => Table0363::class],
        3 => ['class' => ST::class, 'length' => 199, 'opt' => 'C', 'name' => 'Universal Id'],
        4 => ['class' => ID::class, 'length' => 6, 'opt' => 'C', 'name' => 'Universal Id Type', 'table' => Table0301::class],


    ];
}