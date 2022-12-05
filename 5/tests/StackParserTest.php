<?php

declare(strict_types=1);

namespace Test;

class StackParserTest extends \PHPUnit\Framework\TestCase
{
    public function testParsesStackFromString(): void
    {
        $split = preg_split('/\s/', 'A B vv 324');
        $matches = [];
        preg_match_all('/[A-Za-z1-9]+/', 'A B vv 324', $matches);

        $data =   "    [D]    " . PHP_EOL
                . "[N] [C]    " . PHP_EOL
                . "[Z] [M] [P]" . PHP_EOL
                . "1   2   3 ";

        $stackParser = new \Aoc\Parser\StackParser();
        $actual = $stackParser->parse($data);
        $expected = [
            ["N", "Z"],
            ["D", "C", "M"],
            ["P"]
        ];

        $this->assertEquals($actual, $expected);
    }

}