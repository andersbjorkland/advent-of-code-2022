<?php


function readmoves()
{
    $file = file_get_contents(__DIR__ . "/input1.txt");

    $moves = explode("\n", $file);
    $moves = array_map(fn ($move) => str_replace(' ', '', $move), $moves);

    return $moves;
}

function handleMove($move): string
{
    return match($move) {
        'BX','AY','CZ' => 'A',
        'CX','BY','AZ' => 'B',
        default => 'C'
    };
}

function matchStatus($move): string
{
    $statusMove = $move[1];
    return match($statusMove) {
        'X' => 'loss',
        'Y' => 'draw',
        default => 'win'
    };
}

function play(): void
{
    $moves = readmoves();

    $shapeScoreMap = [
        'A' => 1, // rock
        'B' => 2, // paper
        'C' => 3 // scissor
    ];

    $gameScoreMap = [
        'loss' => 0,
        'draw' => 3,
        'win' => 6
    ];

    $totalScore = 0;
    foreach ($moves as $move) {
        $playerMove = handleMove($move);
        $match = matchStatus($move);
        $totalScore += $shapeScoreMap[$playerMove];
        $totalScore += $gameScoreMap[$match];
    }

    echo 'Total score: ' . $totalScore . PHP_EOL;
}

play();

