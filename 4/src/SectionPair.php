<?php

declare(strict_types=1);

namespace Aoc;

use PHPUnit\Util\Exception;

class SectionPair
{
    public function __construct(
        private array $sections = []
    ){}

    public function addSection(Section $section): self
    {
        $this->sections[] = $section;

        return $this;
    }

    public function getSections(): array
    {
        return $this->sections;
    }

    public function hasContainingSections(): bool
    {
        $hasContainingSections = false;

        /** @var Section[] $sections */
        $sections = $this->sections;
        if (count($sections) < 2) {
            throw new Exception('Expected 2 sections to exists, found ' . count($sections));
        }

        $minA = $sections[0]->min;
        $maxA = $sections[0]->max;
        $minB = $sections[1]->min;
        $maxB = $sections[1]->max;

        // Section A contains Section B
        if ($minA <= $minB && $maxA >= $maxB) {
            $hasContainingSections = true;
        }

        // Section B contains Section B
        if ($minB <= $minA && $maxB >= $maxA) {
            $hasContainingSections = true;
        }

        return $hasContainingSections;
    }
}