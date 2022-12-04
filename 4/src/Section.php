<?php

declare(strict_types=1);

namespace Aoc;

class Section
{
    public function __construct(
        readonly public int $min,
        readonly public int $max
    ){}
}