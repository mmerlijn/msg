<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 15:01
 */
namespace mmerlijn\msg\src\Hl7\fields;


class FC extends Field
{
    use parentFieldTrait;
    protected static $name = 'FC';
    protected static $structure = [
        1 => ['class' => IS::class, 'length' => 20, 'opt' => 'R', 'name' => 'Financial Class Code'],
        2 => ['class' => TS::class, 'length' => 26, 'opt' => 'O', 'name' => 'Effective Date'],
    ];
}