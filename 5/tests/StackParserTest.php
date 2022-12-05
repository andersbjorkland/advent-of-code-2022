<?php

declare(strict_types=1);

namespace Test5;

use Aoc5\FileLoader;

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

        $stackParser = new \Aoc5\Parser\StackParser();
        $actual = $stackParser->parse($data);
        $expected = [
            ["Z", "N"],
            ["M", "C", "D"],
            ["P"]
        ];

        $this->assertEquals($actual, $expected);

    }

}