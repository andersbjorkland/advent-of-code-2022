<?php

$testInput =
"30373
25512
65332
33549
35390";

$input = file_get_contents(__DIR__ . '/input.txt');

$rows = explode("\n", $input);
$rows = array_map(fn($rowString) => str_split($rowString), $rows);

$columns = [];
$treeMap = [];
for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
    $treeMap[$rowIndex] = [];
    for ($columnIndex = 0; $columnIndex < count($rows[$rowIndex]); $columnIndex++) {
        // initialize treeMap
        $treeMap[$rowIndex][$columnIndex] = [
            'value' => $rows[$rowIndex][$columnIndex],
            'scenicScore' => 0,
            'isVisibleUp' => false,
            'isVisibleDown' => false,
            'isVisibleLeft' => false,
            'isVisibleRight' => false,
            'isVisible' => false
        ];
        
        
        if ($rowIndex === 0) {
            $columns[$columnIndex] = [];
        }
        $columns[$columnIndex][] = $rows[$rowIndex][$columnIndex];
    }
}

$visibleTrees = 0;

$highScore = 0;
for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
    for ($columnIndex = 0; $columnIndex < count($rows[$rowIndex]); $columnIndex++) {
        // analyze treeMap
        $visibleUp = visibleUp($columns, $rowIndex, $columnIndex);
        $visibleDown = visibleDown($columns, $rowIndex, $columnIndex);
        $visibleLeft = visibleLeft($rows, $rowIndex, $columnIndex);
        $visibleRight = visibleRight($rows, $rowIndex, $columnIndex);

        $viewScoreUp = viewDistanceLess($columns[$columnIndex], $rowIndex);
        $viewScoreDown = viewDistanceGreater($columns[$columnIndex], $rowIndex);
        $viewScoreLeft = viewDistanceLess($rows[$rowIndex], $columnIndex);
        $viewScoreRight = viewDistanceGreater($rows[$rowIndex], $columnIndex);
        $scenicScore = $viewScoreUp * $viewScoreDown * $viewScoreLeft * $viewScoreRight;
        
        if ($scenicScore > $highScore) {
            $highScore = $scenicScore;
        }
        
        $isVisible = $visibleUp || $visibleDown || $visibleLeft || $visibleRight;
        if ($isVisible) {
            $visibleTrees++;
        }
        
        $treeMap[$rowIndex][$columnIndex] = [
            'value' => $rows[$rowIndex][$columnIndex],
            'scenicScore' => $scenicScore,
            'isVisibleUp' => $visibleUp,
            'isVisibleDown' => $visibleDown,
            'isVisibleLeft' => $visibleLeft,
            'isVisibleRight' => $visibleRight,
            'isVisible' => $isVisible
        ];

    }
}

function viewDistanceLess(array $section, int $i): int
{
    $viewDistance = 0;

    if ($i === 0) {
        return $viewDistance;
    }

    $height = (int)$section[$i];
    for ($j = $i - 1; $j >= 0; $j--) {
        $viewDistance++;
        $candidateHeight = (int)$section[$j];
        if ($candidateHeight >= $height) {
            break;
        }
    }
    
    return $viewDistance;
}

function viewDistanceGreater(array $section, int $i): int
{
    $viewDistance = 0;

    if ($i === (count($section) - 1)) {
        return $viewDistance;
    }

    $height = (int) $section[$i];
    for ($j = $i + 1; $j < count($section); $j++) {
        $viewDistance++;
        $candidateHeight = (int)$section[$j];
        if ($candidateHeight >= $height) {
            break;
        }
    }

    return $viewDistance;
}

function visibleUp(array $columns, int $x, int $y): bool
{
    if ($y === 0) {
        return true;
    }
    
    $column = $columns[$x];
    $isVisible = true;
    
    $height = (int)$column[$y];
    for ($i = $y - 1; $i >= 0; $i--) {
        $candidateHeight = (int)$column[$i];
        if ($candidateHeight >= $height) {
            $isVisible = false;
            break;
        }
    }
    
    return $isVisible;
}

function visibleDown(array $columns, int $x, int $y): bool
{
    $column = $columns[$x];
    if ($y === (count($column) - 1)) {
        return true;
    }
 
    $isVisible = true;

    $height = (int)$column[$y];
    for ($i = $y + 1; $i < count($column); $i++) {
        $candidateHeight = (int)$column[$i];
        if ($candidateHeight >= $height) {
            $isVisible = false;
            break;
        }
    }

    return $isVisible;
}

function visibleLeft(array $rows, int $x, int $y): bool
{
    if ($x === 0) {
        return true;
    }

    $row = $rows[$y];
    $isVisible = true;

    $height = (int)$row[$x];
    for ($i = $x - 1; $i >= 0; $i--) {
        $candidateHeight = (int)$row[$i];
        if ($candidateHeight >= $height) {
            $isVisible = false;
            break;
        }
    }

    return $isVisible;
}

function visibleRight(array $rows, int $x, int $y): bool
{
    $row = $rows[$y];

    if ($x === (count($row) - 1)) {
        return true;
    }
    
    $isVisible = true;

    $height = (int)$row[$x];
    for ($i = $x + 1; $i < count($row); $i++) {
        $candidateHeight = (int)$row[$i];
        if ($candidateHeight >= $height) {
            $isVisible = false;
            break;
        }
    }

    return $isVisible;
}

echo PHP_EOL . "Visibile trees: $visibleTrees" . PHP_EOL;

echo PHP_EOL . "Highest scenic score: $highScore" . PHP_EOL;
