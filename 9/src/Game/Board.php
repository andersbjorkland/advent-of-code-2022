<?php

declare(strict_types=1);

namespace Aoc9\Game;

class Board
{
    private array $start = [];

    public function __construct(
        private Piece $head,
        private Piece $tail,
        private int $width = 5,
        private int $height = 5,
        private array $map = [],
    ){
        $this->start = [$head->getX(), $head->getY()];
        
        for ($x = 0; $x < $this->width; $x ++) {
            $map[$x] = [];
            
            for ($y = 0; $y < $this->height; $y++) {
                $map[$x][$y] = null;
            }
        }
        
        $this->map = $map;
    }
    
    public function printBoard(): void
    {
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x ++) {
                $startChar = $this->start[0] === $x && $this->start[1] === $y ? 's' : null;
                
                $head = $this->head->getPiece($x, $y);
                $tail = $this->tail->getPiece($x, $y);
                echo $head ?? $tail ?? $startChar ?? '.';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

}