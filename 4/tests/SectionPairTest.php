<?php

declare(strict_types=1);

namespace Test4;

use Aoc4\Section;
use Aoc4\SectionPair;
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

    public function testHasOverlappingSections(): void
    {
        $sectionPair1 = new SectionPair();
        $sectionPair1
            ->addSection(new Section(5, 7))
            ->addSection(new Section(7, 9));

        $sectionPair2 = new SectionPair();
        $sectionPair2
            ->addSection(new Section(2, 8))
            ->addSection(new Section(3, 7));

        $sectionPair3 = new SectionPair();
        $sectionPair3
            ->addSection(new Section(6, 6))
            ->addSection(new Section(4, 6));

        $sectionPair4 = new SectionPair();
        $sectionPair4
            ->addSection(new Section(5, 9))
            ->addSection(new Section(4, 8));


        $this->assertTrue($sectionPair1->hasOverlappingSections(), (string)$sectionPair1);
        $this->assertTrue($sectionPair2->hasOverlappingSections(), (string)$sectionPair2);
        $this->assertTrue($sectionPair3->hasOverlappingSections(), (string)$sectionPair3);
        $this->assertTrue($sectionPair4->hasOverlappingSections(), (string)$sectionPair4);
    }

    public function testHasNotOverlappingSections(): void
    {
        $sectionPair1 = new SectionPair();
        $sectionPair1
            ->addSection(new Section(2, 4))
            ->addSection(new Section(6, 8));

        $sectionPair2 = new SectionPair();
        $sectionPair2
            ->addSection(new Section(2, 3))
            ->addSection(new Section(4, 5));

        $this->assertNotTrue($sectionPair1->hasOverlappingSections(), (string)$sectionPair1);
        $this->assertNotTrue($sectionPair2->hasOverlappingSections(), (string)$sectionPair2);
    }

}