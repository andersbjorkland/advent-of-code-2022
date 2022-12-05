<?php

declare(strict_types=1);

namespace Test5;

use Aoc5\Parser\InstructionsParser;

class InstructionsParserTest extends \PHPUnit\Framework\TestCase
{
    public function testParsesInstructions(): void
    {
        $instructions = "move 1 from 2 to 1
move 3 from 1 to 3
move 2 from 2 to 1
move 1 from 1 to 2";

        $parser = new InstructionsParser();
        $actual = $parser->parse($instructions);
        $expected = [
            [
                'from' => 2,
                'to' => 1,
                'amount' => 1
            ],
            [
                'from' => 1,
                'to' => 3,
                'amount' => 3
            ],
            [
                'from' => 2,
                'to' => 1,
                'amount' => 2
            ],
            [
                'from' => 1,
                'to' => 2,
                'amount' => 1
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}