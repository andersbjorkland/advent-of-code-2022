<?php

declare(strict_types=1);

namespace Aoc9\Game;

class Game
{
    public function __construct(
        private ?Piece $head = null,
        private array $body = [],
        private ?Board $board = null,
        $boardWidth = 3,
        $boardHeight = 5,
        $startX = 0,
        $startY = 4
    ){
        $this->head = $head ?? new \Aoc9\Game\Piece('H', $startX, $startY, \Aoc9\Game\PieceType::Head);
        
        if (count($this->body) === 0) {
           $this->body[] = new \Aoc9\Game\Piece('T', $startX, $startY, \Aoc9\Game\PieceType::Tail);
        }
        
        $prev = $this->head;
        foreach ($this->body as $piece) {
            $prev->setEntangled($piece);
            
            $prev = $piece;
        }
        
        $this->board = $board ?? new \Aoc9\Game\Board(rope: [$this->head, ...$this->body], width: $boardWidth, height: $boardHeight);
        $this->board->printBoard();
    }
    
    public function progress(Move $move): void
    {
        $this->head->move($move);
        $this->head->updateVisit();
        $this->head->handleEntangled();
        
        foreach ($this->body as $piece) {
            $piece->handleEntangled();
        }
        
        //$this->board->printBoard();
    }
    
    public function getPieceByName(string $name): ?Piece
    {
        /** @var Piece $piece */
        $filteredPieces = array_filter($this->body, fn($piece) => $piece->getName() === $name);
        
        $piece = null;
        if (count($filteredPieces) > 0) {
            $piece = array_pop($filteredPieces);
        }
        
        return $piece;
    }
    
    public function getHead(): ?Piece
    {
        return $this->head;
    }

}