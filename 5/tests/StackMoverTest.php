<?php

declare(strict_types=1);

namespace Test;

use Aoc\StackMover;
use PHPUnit\Framework\TestCase;

class StackMoverTest extends TestCase
{
    public function testHandleStacks(): void
    {
        $stacks =
            [
                ["Z", "N"],
                ["M", "C", "D"],
                ["P"]
            ];
        $instructions =
            [
                [
                    'from' => 2,
                    'to' => 1,
                    'amount' => 1
                ],
                [
                    'from' => 1,
                    'to' => 3,
                    'amount' => 3
                ],
                [
                    'from' => 2,
                    'to' => 1,
                    'amount' => 2
                ],
                [
                    'from' => 1,
                    'to' => 2,
                    'amount' => 1
                ]
            ];
        $mover = new StackMover($stacks, $instructions);
        $actual = $mover->handle();

        $expected = [
            ["C"],
            ["M"],
            ["P", "D", "N", "Z"]
        ];

        $this->assertEquals($expected, $actual);
    }
    
    public function testHandleStacksFor9001(): void
    {
        $stacks =
            [
                ["Z", "N"],
                ["M", "C", "D"],
                ["P"]
            ];
        $instructions =
            [
                [
                    'from' => 2,
                    'to' => 1,
                    'amount' => 1
                ],
                [
                    'from' => 1,
                    'to' => 3,
                    'amount' => 3
                ],
                [
                    'from' => 2,
                    'to' => 1,
                    'amount' => 2
                ],
                [
                    'from' => 1,
                    'to' => 2,
                    'amount' => 1
                ]
            ];
        $mover = new StackMover($stacks, $instructions);
        $actual = $mover->handle(StackMover::STACK_MOVER_9001);

        $expected = [
            ["M"],
            ["C"],
            ["P", "Z", "N", "D"]
        ];

        $this->assertEquals($expected, $actual);
    }
}