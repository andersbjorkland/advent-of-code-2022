<?php

require_once './vendor/autoload.php';

echo "Hello Day 9!" . PHP_EOL;

try {
    $exampleFileContents = 
    "R 4
U 4
L 3
D 1
R 4
D 1
L 5
R 2";
    
    $fileContent = file_get_contents('input.txt');
    
    $startX = 0;
    $startY = 4;
    $bodyLength = 9;
    
    $head = new \Aoc9\Game\Piece('H', $startX, $startY, \Aoc9\Game\PieceType::Head);
    $body = [];
    for ($i = 0; $i < $bodyLength; $i++) {
        $pieceName = $i + 1;
        $body[] = new \Aoc9\Game\Piece('' . $pieceName, $startX, $startY, \Aoc9\Game\PieceType::Numbered);
    }
    
    $game = new \Aoc9\Game\Game(head: $head, body: $body, boardWidth: 6, boardHeight: 5);
    
    $instructionsParser = new \Aoc9\Parser\MovementParser();
    $instructions = $instructionsParser->parse($fileContent);
    
    foreach ($instructions as $instruction) {
        $times = $instruction['times'];
        $move = $instruction['move'];
        for ($i = 0; $i < $times; $i++) {
            $game->progress($move);
        }
    }
    
    $tail = $game->getPieceByName('9');

    echo 'Tail visits: ' . $tail?->getVisitsByThreshold() . PHP_EOL;
    echo 'Head visits: ' . $game->getHead()?->getVisitsByThreshold() . PHP_EOL;
    
} catch (Exception $e) {
    echo $e->getMessage();
}

