<?php

declare(strict_types=1);

namespace Aoc;

class StackMover
{
    public function __construct(
        private array $stacks,
        private array $instructions
    ){}

    public function handle(): array
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

            for($i = 0; $i < $amount; $i++) {
                $toColumn[] = array_pop($fromColumn);
            }

            $stacks[$fromColumnIndex] = $fromColumn;
            $stacks[$toColumnIndex] = $toColumn;
        }

        return $stacks;
    }

}