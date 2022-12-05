<?php

declare(strict_types=1);

namespace Test;

use Aoc\FileLoader;
use Aoc\StackMover;
use Aoc\StackReader;

class SubsetReadTest extends \PHPUnit\Framework\TestCase
{

    public function testHandleSubset(): void
    {
        $fileReader = new FileLoader(FileLoader::STACK_PARSER);
        $stackInstructions = $fileReader->readFile(__DIR__ . '/subsetInput.txt');

        $mover = new StackMover($stackInstructions['stacks'], $stackInstructions['instructions']);
        $movedStacks = $mover->handle();

        $reader = new StackReader();
        $chars = $reader->readStack($movedStacks);

        $this->assertEquals("WCMBCJZ", $chars);


        /*
                                             Z
                                             V
                                             B
                                             J
                                             F
                                             P
                                             Z
                                             V
                                             F
                                             C
                                         J   G
                    [C] [ ] [ ]          V   J
            [W]     [D] [ ] [ ] [B]      B   B
            [P] [ ] [Z] [ ] [ ] [L]      C   Q
            [G] [ ] [N] [ ] [ ] [S] [ ]  Z   H
            [Z] [ ] [H] [ ] [ ] [T] [ ]  F  [C]
            [V] [ ] [M] [M] [ ] [Q] [C] [G] [H]
            [S] [ ] [L] [D] [ ] [F] [G] [L] [F]
            [B] [ ] [V] [L] [ ] [G] [L] [N] [J]
             1   2   3   4   5   6   7   8   9

            W CM BCJZ
         */
    }

}