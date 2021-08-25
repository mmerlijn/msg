<?php


namespace mmerlijn\msg\src\Edifact32\fields;


class C056 extends Field
{
    use ParentFieldTrait;
    protected static $name = 'C056';
    protected static $structure = [
        1 => ['class' => F3413::class,  'opt' => 'C', 'name' => 'Department or employeeidentification'],
        2 => ['class' => F3412::class,  'opt' => 'C', 'name' => 'Department or employee'],
    ];
}