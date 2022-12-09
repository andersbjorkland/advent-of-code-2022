<?php

declare(strict_types=1);

namespace Aoc9\Parser;

use Aoc9\Game\Move;

class MovementParser
{
    public function parse(string $content){
        $rawInstructions = explode("\n", $content);
        $instructions = [];
        
        foreach ($rawInstructions as $rawInstruction) {
            $instructionStructure = explode(' ', $rawInstruction);
            $moveChar = $instructionStructure[0];
            $times = $instructionStructure[1];
            
            $move = match($moveChar) {
                'R' => Move::Right,
                'U' => Move::Up,
                'L' => Move::Left,
                'D' => Move::Down
            };
            
            $instructions[] = [
                'move' => $move,
                'times' => (int)$times
            ];
        }
        
        return $instructions;
    }
}