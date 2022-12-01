<?php

declare(strict_types=1);

$path = __DIR__;
$file = file_get_contents($path . "/input1.txt");

$elves = explode("\n\n", $file);
$elves = array_map(function ($backpack){
    $items = array_map(fn ($item) => (int)$item, explode("\n", $backpack));
    $total = array_reduce($items, fn ($sum, $a) => $sum + $a, 0);
    rsort($items);
    return [
        'items' => $items,
        'total' => $total
    ];
}, $elves);


function sortElves(array $elves): array
{
    usort($elves, function ($aArr, $bArr){
        $a = $aArr['total'];
        $b = $bArr['total'];
        if ($a === $b) {
            return 0;
        }

        return ($a > $b) ? -1 : 1;
    });

    return $elves;
}

$sortedElves = sortElves($elves);
echo 'Top elf Calorie sum: ' . $sortedElves[0]['total'] . PHP_EOL;

$top3Sum = 0;
for ($i = 0; $i < 3; $i++) {
    $top3Sum += $sortedElves[$i]['total'];
}
echo 'Top 3 Sum: ' . $top3Sum . PHP_EOL;
