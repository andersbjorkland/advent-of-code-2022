<?php

use Aoc7\Parser\FileSystemParser;
use Aoc7\Traverser\FileSystemTraverser;

require_once './vendor/autoload.php';

$fileContents = file_get_contents(__DIR__ . '/input.txt');
$parser = new FileSystemParser();
$rootDirectory = $parser->parse($fileContents);

$traverser = new FileSystemTraverser();
$totalSize = $traverser->getTotalSizeOfDirectoriesAtMost(100000, $rootDirectory->getDirectories());

echo PHP_EOL . "Total size of directories (at most 100000): $totalSize" . PHP_EOL;