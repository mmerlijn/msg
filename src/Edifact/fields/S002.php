<?php


namespace mmerlijn\msg\src\Edifact\fields;



class S002 extends Field
{
    use ParentFieldTrait;

    protected static $name = 'S002';
    protected static $structure = [
        1 => ['class' => F0004::class, 'opt' => 'M', 'name' => 'Sender identification'],
        2 => ['class' => F0007::class, 'opt' => 'C', 'name' => 'Partner identification code qualifier'],
        3 => ['class' => F0008::class, 'opt' => 'C', 'name' => 'Address for reverse routing'],
    ];
}