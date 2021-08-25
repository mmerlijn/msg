<?php


namespace mmerlijn\msg\src\Edifact\fields;

class S005 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'S005';
    protected static $structure = [
        1 => ['class' => F0022::class, 'opt' => 'M', 'name' => 'Recipient\'s reference/password'],
        2 => ['class' => F0025::class, 'opt' => 'C', 'name' => 'Recipient\'s reference/password qualifier'],
    ];
}