<?php

declare(strict_types=1);

namespace Test4;

use Aoc4\FileLoader;
use Aoc4\Section;
use Aoc4\SectionPair;

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

    public function testSectionsParser(): void
    {
        $fileLoader = new FileLoader(FileLoader::SECTIONS_PARSER);
        $actual = $fileLoader->readFile(__DIR__ . '/pairs.txt');
        $expected = [
            (new SectionPair())
                ->addSection(new Section(2, 4))
                ->addSection(new Section(6,8)),
            (new SectionPair())
                ->addSection(new Section(2, 3))
                ->addSection(new Section(4,5)),
            (new SectionPair())
                ->addSection(new Section(5, 7))
                ->addSection(new Section(7, 9)),
            (new SectionPair())
                ->addSection(new Section(2, 8))
                ->addSection(new Section(3, 7)),
            (new SectionPair())
                ->addSection(new Section(6, 6))
                ->addSection(new Section(4, 6)),
            (new SectionPair())
                ->addSection(new Section(2, 6))
                ->addSection(new Section(4, 8))
        ];

        $this->assertEquals($expected, $actual);
    }
}