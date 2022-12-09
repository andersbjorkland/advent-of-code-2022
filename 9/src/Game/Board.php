<?php

declare(strict_types=1);

namespace Aoc9\Game;

class Board
{
    public function __construct(
        private Piece $head,
        private Piece $tail,
        private int $width = 5,
        private int $height = 5,
        private array $map = []
    ){
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
                $head = $this->head->getPiece($x, $y);
                $tail = $this->tail->getPiece($x, $y);
                echo $head ?? $tail ?? '.';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

}