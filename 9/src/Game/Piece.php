<?php

declare(strict_types=1);

namespace Aoc9\Game;

use Test9\Game\PieceTest;

class Piece
{
    private $visits = [];
    
    public function __construct(
        private string $name,
        private int $x,
        private int $y,
        private PieceType $type,
        private ?Piece $entangled = null
    ){
        if ($this->entangled !== null) {
            $this->entangled->setEntangled($this);
        }
        
        $this->visits[$x] = [$y => 1];
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
    
    public function getPiece(int $x, int $y): ?self
    {
        $piece = null;
        if ($this->x === $x && $this->y === $y) {
            $piece = $this;
        }
        
        return $piece;
    }
    
    public function __toString(): string
    {
        return $this->name;
    }
    
    public function setEntangled(Piece $entangled): void
    {
        $this->entangled = $entangled;
    }

    /**
     * @return PieceType
     */
    public function getType(): PieceType
    {
        return $this->type;
    }

    /**
     * @return Piece
     */
    public function getEntangled(): Piece
    {
        return $this->entangled;
    }
    
    public function move(Move $move): void
    {
        match ($move) {
          Move::Up => $this->y--,
          Move::Down => $this->y++,
          Move::Left => $this->x--,
          Move::Right => $this->x++   
        };
    }
    
    public function handleEntangled(): void
    {
        $entangled = $this->entangled;
        if ($entangled === null) {
            return;
        }
        
        if ($this->calculateDistance() > 1) {
            $pieceX = $this->x;
            $pieceY = $this->y;

            $entangledX = $entangled->getX();
            $entangledY = $entangled->getY();

            // they are already at same column or row
            $sameRow = $entangledY === $pieceY;
            $sameColumn = $entangledX === $pieceX;
            if ($sameColumn) {
                $this->handleColumnMove($entangled);
            } else if ($sameRow) {
                $this->handleRowMove($entangled);
            } else {
                $this->handleDiagonalMove($entangled);
            }

            $entangled->updateVisit();
        }
    }
    
    public function calculateDistance():int
    {
        $distance = 0;
        
        $pieceX = $this->x;
        $pieceY = $this->y;
        
        $entangledX = $this->entangled->getX();
        $entangledY = $this->entangled->getY();
        
        $distance = max(
            abs($entangledX - $pieceX),
            abs($entangledY - $pieceY)
        );
        
        return $distance;
    }
    
    private function handleColumnMove(Piece $entangled): void
    {
        $pieceY = $this->y;
        $entangledY = $entangled->getY();
        $move = $pieceY - $entangledY > 0 ? Move::Down : Move::Up;
        
        $entangled->move($move);
    }
    
    private function handleRowMove(Piece $entangled): void
    {
        $pieceX = $this->x;
        $entangledX = $entangled->getX();
        $move = $pieceX - $entangledX > 0 ? Move::Right : Move::Left;
        
        $entangled->move($move);
    }

    private function handleDiagonalMove(?Piece $entangled): void
    {
        $xDiff = $this->x - $entangled->getX();
        $yDiff = $this->y - $entangled->getY();
        
        if ($yDiff > 0) {
            $entangled->move(Move::Down);
        } else {
            $entangled->move(Move::Up);
        }
        
        if ($xDiff > 0) {
            $entangled->move(Move::Right);
        } else {
            $entangled->move(Move::Left);
        }
        
    }
    
    public function getVisits(): array
    {
        return $this->visits;
    }
    
    public function updateVisit(): void 
    {
        $x = $this->x;
        $y = $this->y;

        if (!key_exists($x, $this->visits)) {
            $this->visits[$x] = [];
        }
        
        if (!key_exists($y, $this->visits[$x])) {
            $this->visits[$x][$y] = 0;
        }

        $this->visits[$x][$y] += 1;
    }
    
    public function getVisitsByThreshold(int $threshold = 1): int
    {
        $sum = 0;
        
        foreach ($this->visits as $row) {
            foreach ($row as $cell) {
                if ($cell >= $threshold) {
                    $sum++;
                }
            }
        }
        
//        for ($x = 0; $x < count($this->visits); $x++) {
//            for ($y = 0; $y < count($this->visits[$x]); $y++) {
//                if ($this->visits[$x][$y] >= $threshold) {
//                    $sum += 1;
//                }
//            }
//        }
        
        return $sum;
        
    }

}