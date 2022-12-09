<?php

declare(strict_types=1);

namespace Aoc9\Game;

class Piece
{
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

        // if difference greater in x-way, then move into the same row and closer
        //if (abs($xDiff) > abs($yDiff)) {
            if ($yDiff > 0) {
                $entangled->move(Move::Down);
            } else {
                $entangled->move(Move::Up);
            }
            
            
            // if entangled is less than piece, then move to the right
            if ($xDiff > 0) {
                $entangled->move(Move::Right);
            } else {
                $entangled->move(Move::Left);
            }
        //} else {
            // else move into the same column and closer
            
        //}
        
        
    }

}