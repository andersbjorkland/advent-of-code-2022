<?php

spl_autoload_register(fn ($className) => include $className . '.php');



function sumRucksacks(array $data): int
{
    $sum = 0;
    try {
        $sum = array_reduce($data, function($carry, $rucksack) {
            $charEvaluator = new CharEvaluator();
            return $carry + $charEvaluator->getCharValue($rucksack['doubled']);
        }, 0);

    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }

    return $sum;
}

function groupBy3(array $data): array
{
    $groups = [];
    $group = [
        'rucksacks' => []
    ];

    $count = count($data);
    $itemSet = [];
    $uniqueItem = '';
    for ($i = 0; $i < $count; $i++) {
        if (($i > 0 && $i % 3 === 0)) {
            $group['unique'] = $uniqueItem;
            $group['itemSet'] = $itemSet;
            $groups[] = $group;

            $group = [];
            $group['rucksacks'] = [];
            $itemSet = [];
            $uniqueItem = '';
        }

        $rucksack = $data[$i];
        $rucksackItems = array_keys($rucksack['whole']);
        foreach ($rucksackItems as $item) {
            if (!array_key_exists($item, $itemSet)){
                $itemSet[$item] = 0;
            }

            $itemSet[$item] += 1;
            if ($itemSet[$item] === 3) {
                $uniqueItem = $item;
            }

        }

        if ($i + 1 === $count && $i % 3 !== 0) {
            $group['unique'] = $uniqueItem;
            $group['itemSet'] = $itemSet;
            $groups[] = $group;
        }

        $group['rucksacks'][] = $rucksack;
    }

    return $groups;

}

function sumGroups(array $groups): int
{
    $sum = 0;
    try {
        $sum = array_reduce($groups, function($carry, $group) {
            $charEvaluator = new CharEvaluator();
            return $carry + $charEvaluator->getCharValue($group['unique']);
        }, 0);

    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }

    return $sum;
}

$fileReader = new FileReader();
$data = $fileReader->readFileToArray('mainInput.txt');


echo 'SUM: ' .  sumRucksacks($data) . PHP_EOL;

$groups = groupBy3($data);

echo 'SUM for groups: ' . sumGroups($groups) . PHP_EOL;