<?php

declare(strict_types=1);

namespace Test7\Parser;

use Aoc7\Parser\FileSystemParser;

class FileSystemParserTest extends \PHPUnit\Framework\TestCase
{
    public function testParsing(): void
    {
        $fileContents = file_get_contents(__DIR__ . '/../input.txt');
        $parser = new FileSystemParser();
        $rootDirectory = $parser->parse($fileContents);
        
        $expectedFileSizeForRoot = 48381165;
        $this->assertEquals($expectedFileSizeForRoot, $rootDirectory->getTotalSize());
    }
}