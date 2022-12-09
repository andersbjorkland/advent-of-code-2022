<?php

declare(strict_types=1);

namespace Test9\Game;

use Aoc9\Game\Piece;
use Aoc9\Game\PieceType;

class PieceTest extends \PHPUnit\Framework\TestCase
{
    public function testOneDistance(): void
    {
        $head = new Piece('h', 0, 0, PieceType::Head);
        $tail = new Piece('t', 1, 1, PieceType::Tail, $head);
        
        $actual = $head->calculateDistance();
        $expected = 1;
        
        $this->assertEquals($expected, $actual);
    }
    
    public function testTwoDistance(): void
    {
        $head = new Piece('h', 0, 0, PieceType::Head);
        $tail = new Piece('t', 2, 1, PieceType::Tail, $head);

        $actual = $head->calculateDistance();
        $expected = 2;

        $this->assertEquals($expected, $actual);
    }

    public function testDiagonalTwoDistance(): void
    {
        $head = new Piece('h', 0, 0, PieceType::Head);
        $tail = new Piece('t', 2, 2, PieceType::Tail, $head);

        $actual = $head->calculateDistance();
        $expected = 2;

        $this->assertEquals($expected, $actual);
    }
}