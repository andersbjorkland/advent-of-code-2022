<?php

require_once './vendor/autoload.php';

echo "Hello Day 9!" . PHP_EOL;

try {
    $game = new \Aoc9\Game\Game();
    $game->progress(\Aoc9\Game\Move::Up);
} catch (Exception $e) {
    echo $e->getMessage();
}

