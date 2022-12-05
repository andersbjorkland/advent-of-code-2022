<?php

require_once './vendor/autoload.php';

$fileLoader = new \Aoc5\FileLoader(\Aoc5\FileLoader::STACK_PARSER);
$data = $fileLoader->readFile(__DIR__ . '/majorInput.txt');

$stacks = $data['stacks'];
$instructions = $data['instructions'];

$movedStacks = (new \Aoc5\StackMover($stacks, $instructions))->handle();

$stackChars = (new \Aoc5\StackReader())->readStack($movedStacks);

echo "Chars: " . $stackChars . PHP_EOL;

$movedBy9001 = (new \Aoc5\StackMover($stacks, $instructions))->handle(\Aoc5\StackMover::STACK_MOVER_9001);
$stacked9001Chars = (new \Aoc5\StackReader())->readStack($movedBy9001);

echo PHP_EOL . "Chars for 9001 stacker: " . $stacked9001Chars . PHP_EOL;
