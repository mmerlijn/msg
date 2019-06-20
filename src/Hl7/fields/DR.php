<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 28-1-2019
 * Time: 15:39
 */

namespace mmerlijn\msg\src\Hl7\fields;


class DR extends Field
{
    use parentFieldTrait;
    protected static $name = 'DR';
    private static $structure = [
        1 => ['class' => DTM::class, 'length' => 26, 'opt' => 'O', 'name' => 'Range Start Date/Time'],
        2 => ['class' => DTM::class, 'length' => 26, 'opt' => 'O', 'name' => 'Range End Date/Time'],

    ];


}