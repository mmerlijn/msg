<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:08
 */

namespace mmerlijn\msg\src\Hl7\fields;


class EIP extends Field
{
    use parentFieldTrait;
    protected static $name = 'EIP';
    protected static $structure = [
        1 => ['class' => EI::class, 'length' => 427, 'opt' => 'O', 'name' => 'Placer Assigned Identifier'],
        2 => ['class' => EI::class, 'length' => 427, 'opt' => 'O', 'name' => 'Filler Assigned Identifier'],
    ];
}