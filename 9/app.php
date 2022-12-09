<?php

require_once './vendor/autoload.php';

echo "Hello Day 9!" . PHP_EOL;

$head = new \Aoc9\Game\Piece('H', 2, 1, \Aoc9\Game\PieceType::Head);
$tail = new \Aoc9\Game\Piece('T', 2, 2, \Aoc9\Game\PieceType::Tail, entangled: $head);
$board = new \Aoc9\Game\Board(width: 3, head: $head, tail: $tail);

$board->printBoard();

$head->move(\Aoc9\Game\Move::Up);

$board->printBoard();

$head->handleEntangled();

$board->printBoard();