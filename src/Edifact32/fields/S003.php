<?php


namespace mmerlijn\msg\src\Edifact32\fields;

class S003 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'S003';
    protected static $structure = [
        1 => ['class' => F0010::class, 'opt' => 'M', 'name' => 'Recipient identification'],
        2 => ['class' => F0007::class, 'opt' => 'C', 'name' => 'Partner identification code qualifier'],
        3 => ['class' => F0014::class, 'opt' => 'C', 'name' => 'Routing address'],
    ];
}