<?php

namespace Aoc5\Parser;

interface ParseInterface
{
    public function parse(string $fileContent): array;
}