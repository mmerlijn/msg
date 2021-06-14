<?php

namespace mmerlijn\msg\tests;


use mmerlijn\msg\src\Tools\StringSplitter;

use PHPUnit\Framework\TestCase;

class ToolTest extends TestCase
{

    public function test_split()
    {

        $string = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium adipisci, aliquid beatae commodi eaque eligendi explicabo fuga fugit, laboriosam, maxime minima mollitia perferendis placeat praesentium qui sint suscipit tempore.";
        $parts = (new StringSplitter())->of($string)->splitString(30);
        $this->assertSame(
            [
                'Lorem ipsum dolor sit amet,',
                'consectetur adipisicing elit.',
                'Accusamus accusantium',
                'adipisci, aliquid beatae',
                'commodi eaque eligendi',
                'explicabo fuga fugit,',
                'laboriosam, maxime minima',
                'mollitia perferendis placeat',
                'praesentium qui sint suscipit',
                'tempore.'
            ],
            $parts);

        $string = "Lorem ipsum dolor";
        $parts = (new StringSplitter())->of($string)->splitString(30);
        $this->assertSame(
            [
                'Lorem ipsum dolor',
            ],
            $parts);
    }

}
