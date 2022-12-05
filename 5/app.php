<?php

require_once './vendor/autoload.php';

$fileLoader = new \Aoc\FileLoader(\Aoc\FileLoader::STACK_PARSER);
$data = $fileLoader->readFile(__DIR__ . '/majorInput.txt');

$stacks = $data['stacks'];
$instructions = $data['instructions'];

$movedStacks = (new \Aoc\StackMover($stacks, $instructions))->handle();

$stackChars = (new \Aoc\StackReader())->readStack($movedStacks);

echo "Chars: " . $stackChars . PHP_EOL;

$movedBy9001 = (new \Aoc\StackMover($stacks, $instructions))->handle(\Aoc\StackMover::STACK_MOVER_9001);
$stacked9001Chars = (new \Aoc\StackReader())->readStack($movedBy9001);

echo PHP_EOL . "Chars for 9001 stacker: " . $stacked9001Chars . PHP_EOL;
