<?php

declare(strict_types=1);

namespace Test4;

use Aoc4\Section;
use Aoc4\SectionPair;

class OverlapCounterTest extends \PHPUnit\Framework\TestCase
{
    public function testContainsCount(): void
    {
        $overlapCounter = new \Aoc4\OverlapCounter();
        $sectionPairs = [
            (new SectionPair())
                ->addSection(new Section(2, 4))
                ->addSection(new Section(6,8)),
            (new SectionPair())
                ->addSection(new Section(2, 3))
                ->addSection(new Section(4,5)),
            (new SectionPair())
                ->addSection(new Section(5, 7))
                ->addSection(new Section(7, 9)),
            (new SectionPair())
                ->addSection(new Section(2, 8))
                ->addSection(new Section(3, 7)),
            (new SectionPair())
                ->addSection(new Section(6, 6))
                ->addSection(new Section(4, 6)),
            (new SectionPair())
                ->addSection(new Section(2, 6))
                ->addSection(new Section(4, 8))
        ];

        $expected = 2;
        $actual = $overlapCounter->countContains($sectionPairs);

        $this->assertEquals($expected, $actual);
    }

    public function testOverlapCount(): void
    {
        $overlapCounter = new \Aoc4\OverlapCounter();
        $sectionPairs = [
            (new SectionPair())
                ->addSection(new Section(2, 4))
                ->addSection(new Section(6,8)),
            (new SectionPair())
                ->addSection(new Section(2, 3))
                ->addSection(new Section(4,5)),
            (new SectionPair())
                ->addSection(new Section(5, 7))
                ->addSection(new Section(7, 9)),
            (new SectionPair())
                ->addSection(new Section(2, 8))
                ->addSection(new Section(3, 7)),
            (new SectionPair())
                ->addSection(new Section(6, 6))
                ->addSection(new Section(4, 6)),
            (new SectionPair())
                ->addSection(new Section(2, 6))
                ->addSection(new Section(4, 8))
        ];

        $expected = 4;
        $actual = $overlapCounter->countOverlap($sectionPairs);
        $this->assertEquals($expected, $actual);
    }
}