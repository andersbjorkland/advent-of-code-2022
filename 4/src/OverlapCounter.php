<?php

declare(strict_types=1);

namespace Aoc;

use Exception;

class OverlapCounter
{
    /**
     * @param SectionPair[] $sectionPairs
     * @return int
     */
    public function countOverlaps(array $sectionPairs): int
    {
        try {
            $overlaps = array_reduce(
                $sectionPairs,
                fn ($sum, SectionPair $sectionPair) => $sectionPair->hasContainingSections() ? ++$sum : $sum
                , 0
            );
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }


        return $overlaps;
    }
}