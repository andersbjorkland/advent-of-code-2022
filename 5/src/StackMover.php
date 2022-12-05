<?php

declare(strict_types=1);

namespace Aoc5;

class StackMover
{
    const STACK_MOVER_9000 = 0;
    const STACK_MOVER_9001 = 1;
    
    public function __construct(
        private array $stacks,
        private array $instructions
    ){}

    public function handle($configuration = self::STACK_MOVER_9000): array
    {
        $stacks = $this->stacks;
        $instructions = $this->instructions;

        foreach ($instructions as $instruction) {
            $fromColumnIndex = $instruction['from'] - 1;
            $toColumnIndex = $instruction['to'] - 1;
            $amount = $instruction['amount'];

            $fromColumn = $stacks[$fromColumnIndex];
            $toColumn = $stacks[$toColumnIndex];
            $items = [];

            $moveStack = [];
            for($i = 0; $i < $amount; $i++) {
                $moveStack[] = array_pop($fromColumn);
            }
            
            if ($configuration === self::STACK_MOVER_9001) {
                $moveStack = array_reverse($moveStack);
            }
            
            array_push($toColumn, ...$moveStack);

            $stacks[$fromColumnIndex] = $fromColumn;
            $stacks[$toColumnIndex] = $toColumn;
        }

        return $stacks;
    }

}