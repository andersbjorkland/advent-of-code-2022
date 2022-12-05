<?php

require_once './vendor/autoload.php';

$fileLoader = new \Aoc\FileLoader(\Aoc\FileLoader::DOUBLE_LINE_PARSER);
$data = $fileLoader->readFile(__DIR__ . '/input.txt');

