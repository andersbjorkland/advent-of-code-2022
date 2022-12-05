<?php

declare(strict_types=1);

namespace Aoc5;

class StackReader
{
    public function readStack(array $stacks): string
    {
        $stackChars = '';
        foreach ($stacks as $stack) {
            $char = array_pop($stack);
            $stackChars .= $char;
        }

        return $stackChars;
    }

}