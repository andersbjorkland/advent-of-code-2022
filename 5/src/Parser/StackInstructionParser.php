<?php

declare(strict_types=1);

namespace Aoc\Parser;

class StackInstructionParser implements ParseInterface
{

    public function __construct(
        private readonly InstructionsParser $instructionsParser = new InstructionsParser(),
        private readonly StackParser $stackParser = new StackParser()
    ){}

    public function parse(string $fileContent): array
    {
        $stackInstructions = [];

        $contents = explode("\n\n", $fileContent);
        $stackContents = $contents[0];
        $instructionContents = $contents[1];

        $stacks = $this->stackParser->parse($stackContents);
        $instructions = $this->instructionsParser->parse($instructionContents);

        $stackInstructions["stacks"] = $stacks;
        $stackInstructions["instructions"] = $instructions;

        return $stackInstructions;
    }
}