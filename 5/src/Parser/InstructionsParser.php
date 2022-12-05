<?php

declare(strict_types=1);

namespace Aoc\Parser;

class InstructionsParser implements ParseInterface
{

    public function parse(string $fileContent): array
    {
        $instructions = [];

        $rawInstructions = explode("\n", $fileContent);
        foreach ($rawInstructions as $rawInstruction) {
            $matches = [];

            preg_match_all('/[0-9]+/', $rawInstruction, $matches);

            $matchedInstruction = array_pop($matches);
            $amount = $matchedInstruction[0];
            $from = $matchedInstruction[1];
            $to = $matchedInstruction[2];

            $instruction = [
                'from' => $from,
                'to' => $to,
                'amount' => $amount
            ];

            $instructions[] = $instruction;

        }


        return $instructions;
    }
}