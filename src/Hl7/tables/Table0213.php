<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 2-2-2019
 * Time: 14:38
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0213 extends Table
{
    protected static $name = 'Purge Status Code';
    protected static $table = [
        "P" => "Marked for purge.  User is no longer able to update the visit.",
        "D" => "The visit is marked for deletion and the user cannot enter new data against it.",
        "I" => "The visit is marked inactive and the user cannot enter new data against it.",
    ];
}