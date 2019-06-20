<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 22:59
 */
namespace mmerlijn\msg\src\Hl7\fields;


use mmerlijn\msg\src\Hl7\tables\Table0369;

class SPS extends Field
{
    use parentFieldTrait;
    protected static $name = 'SPS';
    protected static $structure = [
        1 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Specimen Source Name Or Code'],
        2 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Additives'], //table0371
        3 => ['class' => TX::class, 'length' => 200, 'opt' => 'O', 'name' => 'Specimen Collection Method'],
        4 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Body Site'],  //table0163
        5 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Site Modifier'], //table0495
        6 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Collection Method Modifier Code'],
        7 => ['class' => CWE::class, 'length' => 705, 'opt' => 'O', 'name' => 'Specimen Role', 'table' => Table0369::class],

    ];
}