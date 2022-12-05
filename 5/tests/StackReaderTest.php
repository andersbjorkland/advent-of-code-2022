<?php

declare(strict_types=1);

namespace Test5;

use Aoc5\StackReader;

class StackReaderTest extends \PHPUnit\Framework\TestCase
{
    public function testReadStack(): void
    {
        $reader = new StackReader();

        $stacks =
            [
                ["C"],
                ["M"],
                ["P", "D", "N", "Z"]
            ];

        $actual = $reader->readStack($stacks);
        $expected = "CMZ";

        $this->assertEquals($expected, $actual);
    }

}