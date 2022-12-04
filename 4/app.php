<?php

require_once './vendor/autoload.php';

$fileLoader = new \Aoc\FileLoader(\Aoc\FileLoader::SECTIONS_PARSER);
$sectionPairs = $fileLoader->readFile(__DIR__ . '/input.txt');

$counter = new \Aoc\OverlapCounter();
$containsCount = $counter->countContains($sectionPairs);
echo 'Contains Count: ' . $containsCount . PHP_EOL;

$overlapCount = $counter->countOverlap($sectionPairs);
echo 'Overlap Count: ' . $overlapCount . PHP_EOL;