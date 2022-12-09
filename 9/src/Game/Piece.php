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
        
        $moveForColumn = false;
        $moveForRow = false;
        
        $pieceX = $this->x;
        $pieceY = $this->y;
        
        $entangledX = $entangled->getX();
        $entangledY = $entangled->getY();
        
        // they are already at same column or row
        $sameRow = $entangledY === $pieceY;
        $sameColumn = $entangledX === $pieceX;
        if ($sameColumn) {
            $this->handleColumnMove($entangled);
        }
    }
    
    public function handleColumnMove(Piece $entangled): void
    {
        $pieceY = $this->y;
        $entangledY = $entangled->getY();
        $move = $pieceY - $entangledY > 0 ? Move::Down : Move::Up;
        
        $entangled->move($move);
    }
    
}