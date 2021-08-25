<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C082 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C082';
    protected static $structure = [
        1 => ['class' => F3039::class, 'opt' => 'C', 'name' => 'Document name code'],
        2 => ['class' => F1131::class, 'opt' => 'C', 'name' => 'Code list identification code'],
        3 => ['class' => F3055::class, 'opt' => 'C', 'name' => 'Code list responsible agency code'],
    ];
}