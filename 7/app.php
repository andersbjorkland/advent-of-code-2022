<?php

use Aoc7\FileSystem\Directory;
use Aoc7\Parser\FileSystemParser;
use Aoc7\Traverser\FileSystemTraverser;

require_once './vendor/autoload.php';

$fileContents = file_get_contents(__DIR__ . '/input.txt');
$parser = new FileSystemParser();
$rootDirectory = $parser->parse($fileContents);

$traverser = new FileSystemTraverser();
$totalSize = $traverser->getTotalSizeOfDirectoriesAtMost(100000, $rootDirectory->getDirectories());

echo PHP_EOL . "Total size of directories (at most 100000): $totalSize" . PHP_EOL;

$candidates = $traverser->filterDirectoriesAtLeast(8381165, $rootDirectory->getDirectories());

/** @var Directory $smallestCandidate */
$smallestCandidate = array_reduce(
    $candidates, 
    function (?Directory $carry, Directory $candidate) {
        if ($carry === null) {
            return $candidate;
        }
        return $carry->getTotalSize() > $candidate->getTotalSize() ? $candidate : $carry;   
    }
);
$smallestCandidateSize = $smallestCandidate->getTotalSize();
echo PHP_EOL . "Total size of smallest candidate: $smallestCandidateSize" . PHP_EOL;
