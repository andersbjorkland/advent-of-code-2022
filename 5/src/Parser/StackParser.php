<?php

declare(strict_types=1);

namespace Aoc\Parser;

class StackParser implements ParseInterface
{

    public function parse(string $fileContent): array
    {
        $numberOfColumnsMatches = [];
        preg_match_all('/([0-9])+/', $fileContent, $numberOfColumnsMatches);
        $numberOfColumns = (int)array_pop($numberOfColumnsMatches[0]);

        $stackMatches = [];
        preg_match_all('/((\[\w]\s?)|(\s){3}(\s))/', $fileContent, $stackMatches);

        $stacks = array_fill(0, $numberOfColumns, []);
        $capturedStackMatches = $stackMatches[0];
        $countStackItems = count($capturedStackMatches);
        $stack = [];
        for ($i = 0; $i < $countStackItems; $i++) {
            $char = '';
            $charMatch = [];
            $charIsPresent = preg_match('/[A-Z]/', $capturedStackMatches[$i], $charMatch);
            if ($charIsPresent) {
                $char = array_pop($charMatch);
                $stackIndex = ($i) % $numberOfColumns;

                $stacks[$stackIndex][] = $char;
            }

        }

        return $stacks;
    }
}