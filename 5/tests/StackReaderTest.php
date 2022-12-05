<?php

declare(strict_types=1);

namespace Test;

use Aoc\StackReader;

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