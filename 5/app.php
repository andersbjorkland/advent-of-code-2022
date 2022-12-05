<?php

require_once './vendor/autoload.php';

$fileLoader = new \Aoc\FileLoader(\Aoc\FileLoader::STACK_PARSER);
$data = $fileLoader->readFile(__DIR__ . '/majorInput.txt');

$stacks = $data['stacks'];
$instructions = $data['instructions'];

$movedStacks = (new \Aoc\StackMover($stacks, $instructions))->handle();

$stackChars = (new \Aoc\StackReader())->readStack($movedStacks);

echo "Chars: " . $stackChars . PHP_EOL;

