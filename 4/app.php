<?php

require_once './vendor/autoload.php';

$fileLoader = new \Aoc4\FileLoader(\Aoc4\FileLoader::SECTIONS_PARSER);
$sectionPairs = $fileLoader->readFile(__DIR__ . '/input.txt');

$counter = new \Aoc4\OverlapCounter();
$containsCount = $counter->countContains($sectionPairs);
echo 'Contains Count: ' . $containsCount . PHP_EOL;

$overlapCount = $counter->countOverlap($sectionPairs);
echo 'Overlap Count: ' . $overlapCount . PHP_EOL;