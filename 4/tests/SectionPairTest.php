<?php

declare(strict_types=1);

namespace Tests;

use Aoc\Section;
use Aoc\SectionPair;
use PHPUnit\Framework\TestCase;

class SectionPairTest extends TestCase
{
    public function testHasContainingSections(): void
    {
        $sectionPair1 = new SectionPair();
        $sectionPair1
            ->addSection(new Section(2, 8))
            ->addSection(new Section(3, 7));

        $sectionPair2 = new SectionPair();
        $sectionPair2
            ->addSection(new Section(3, 7))
            ->addSection(new Section(2, 8));

        $this->assertTrue($sectionPair1->hasContainingSections(), 'Section 2-8 contains Sectoin 3-7');
        $this->assertTrue($sectionPair2->hasContainingSections(), 'Section 3-7 is contained in Section 2-8');

    }

    public function testHasNoContainingSections(): void
    {
        $sectionPair1 = new SectionPair();
        $sectionPair1
            ->addSection(new Section(2, 4))
            ->addSection(new Section(3, 7));

        $sectionPair2 = new SectionPair();
        $sectionPair2
            ->addSection(new Section(2, 4))
            ->addSection(new Section(5, 7));

        $this->assertNotTrue($sectionPair1->hasContainingSections());
        $this->assertNotTrue($sectionPair2->hasContainingSections());
    }

}