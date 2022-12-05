<?php

namespace Aoc\Parser;

interface ParseInterface
{
    public function parse(string $fileContent): array;
}