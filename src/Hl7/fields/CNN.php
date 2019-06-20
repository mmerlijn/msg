<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 23:14
 */


namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0301;
use mmerlijn\msg\src\Hl7\tables\Table0360;
use mmerlijn\msg\src\Hl7\tables\Table0363;

class CNN extends Field
{
    use parentFieldTrait;
    protected static $name = 'CNN';
    protected static $structure = [
        1 => ['class' => ST::class, 'length' => 15, 'opt' => 'O', 'name' => 'Id Number'],
        2 => ['class' => ST::class, 'length' => 50, 'opt' => 'O', 'name' => 'Family Name'],
        3 => ['class' => ST::class, 'length' => 30, 'opt' => 'O', 'name' => 'Given Name'],
        4 => ['class' => ST::class, 'length' => 30, 'opt' => 'O', 'name' => 'Second And Further Given Names Or Initials Thereo'],
        5 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Suffix'],
        6 => ['class' => ST::class, 'length' => 20, 'opt' => 'O', 'name' => 'Prefix'],
        7 => ['class' => IS::class, 'length' => 5, 'opt' => 'O', 'name' => 'Degree', 'table' => Table0360::class],
        8 => ['class' => IS::class, 'length' => 4, 'opt' => 'C', 'name' => 'Source Table'],//table0297
        9 => ['class' => IS::class, 'length' => 20, 'opt' => 'C', 'name' => 'Assigning Authority- Namespace Id', 'table' => Table0363::class],
        10 => ['class' => ST::class, 'length' => 199, 'opt' => 'C', 'name' => '	Assigning Authority- Universal Id'],
        11 => ['class' => ID::class, 'length' => 6, 'opt' => 'C', 'name' => 'Assigning Authority- Universal Id Type', 'table' => Table0301::class],


    ];
}