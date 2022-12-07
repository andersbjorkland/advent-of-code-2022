<?php

declare(strict_types=1);

namespace Test7\Traverser;

use Aoc7\Parser\FileSystemParser;
use Aoc7\Traverser\FileSystemTraverser;

class FileSystemTraverserTest extends \PHPUnit\Framework\TestCase
{
    public function testHasCorrectDirectories(): void
    {
        $fileContents = file_get_contents(__DIR__ . '/../input.txt');
        $parser = new FileSystemParser();
        $rootDirectory = $parser->parse($fileContents);
        
        $traverser = new FileSystemTraverser();
        
        $directories = $traverser->filterDirectoriesAtMost(100000, $rootDirectory->getDirectories());

        $aDirectory = array_filter($directories, fn($directory) => $directory->getName() === 'a');
        $eDirectory = array_filter($directories, fn($directory) => $directory->getName() === 'e');
        
        $this->assertTrue(count($aDirectory) > 0 && count($eDirectory) > 0);
    }
    
    public function testGetsCorrectSize(): void
    {
        $fileContents = file_get_contents(__DIR__ . '/../input.txt');
        $parser = new FileSystemParser();
        $rootDirectory = $parser->parse($fileContents);

        $traverser = new FileSystemTraverser();
        
        $totalSize = $traverser->getTotalSizeOfDirectoriesAtMost(100000, $rootDirectory->getDirectories());
        $expectedSize = 95437;
        
        $this->assertEquals($expectedSize, $totalSize);
        
    }
}