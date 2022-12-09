<?php

declare(strict_types=1);

namespace Aoc9\Game;

class Game
{
    public function __construct(
        private ?Piece $head = null,
        private ?Piece $tail = null,
        private ?Board $board = null,
        $boardWidth = 3,
        $boardHeight = 5,
        $startX = 0,
        $startY = 4
    ){
        $this->head = $head ?? new \Aoc9\Game\Piece('H', $startX, $startY, \Aoc9\Game\PieceType::Head);
        $this->tail = $tail ?? new \Aoc9\Game\Piece('T', $startX, $startY, \Aoc9\Game\PieceType::Tail, entangled: $this->head);
        $this->board = $board ?? new \Aoc9\Game\Board(head: $this->head, tail: $this->tail, width: $boardWidth, height: $boardHeight);
    }
    
    public function progress(Move $move): void
    {
        $this->board->printBoard();
        $this->head->move($move);
        $this->head->handleEntangled();
        $this->board->printBoard();
    }

}