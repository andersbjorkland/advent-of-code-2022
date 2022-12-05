<?php

declare(strict_types=1);

namespace Test;

use Aoc\Parser\StackInstructionParser;

class StackInstructionParserTest extends \PHPUnit\Framework\TestCase
{
    public function testParsesInstructionsAndStacks(): void
    {
        $data = file_get_contents(__DIR__ . '/input.txt');

        $parser = new StackInstructionParser();

        $actual = $parser->parse($data);
        $expected = [
            'stacks' => [
                ["N", "Z"],
                ["D", "C", "M"],
                ["P"]
            ],
            'instructions' => [
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
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}