<?php

declare(strict_types=1);

namespace Tests;

use Aoc\FileLoader;

class FileLoaderTest extends \PHPUnit\Framework\TestCase
{
    public function testDoubleLineSeparatedFile(): void
    {
        $fileLoader = new FileLoader();
        $actual = $fileLoader->readFile(__DIR__ . '/testFile.txt');
        $expected = [
            ["aabbdd", "aabb", "aa"],
            ["bbccdd", "bbcc", "bb"]
        ];

        $this->assertEquals($expected, $actual);
    }
}