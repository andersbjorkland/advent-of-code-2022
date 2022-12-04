<?php

require_once './vendor/autoload.php';

$fileLoader = new \Aoc\FileLoader(\Aoc\FileLoader::SECTIONS_PARSER);
$sectionPairs = $fileLoader->readFile(__DIR__ . '/input.txt');

$counter = new \Aoc\OverlapCounter();
$count = $counter->countOverlaps($sectionPairs);

echo 'Count: ' . $count . PHP_EOL;