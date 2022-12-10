<?php

declare(strict_types=1);

namespace Aoc9\Game;

class Board
{
    private array $start = [];

    public function __construct(
        private array $rope = [],
        private int $width = 5,
        private int $height = 5,
        private array $map = [],
    ){
        if (count($this->rope) !== 0) {
            $head = $rope[0];
            $this->start = [$head->getX(), $head->getY()];
        }
        
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
                
                echo $this->getPieceCharForPosition($x, $y) ?? $startChar ?? '.';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
    
    protected function getPieceCharForPosition(int $x, int $y): ?string
    {
        $char = null;
        /** @var Piece $piece */
        foreach ($this->rope as $piece) {
            $candidate = $piece->getPiece($x, $y);
            
            if ($candidate !== null) {
                $char = $candidate->getName();
                break;
            }
        }
        
        return $char;
    }

}