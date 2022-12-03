<?php

spl_autoload_register(fn ($className) => include $className . '.php');



function sumRucksacks()
{
    $fileReader = new FileReader();
    $data = $fileReader->readFileToArray('mainInput.txt');

    try {
        $sum = array_reduce($data, function($carry, $rucksack) {
            $charEvaluator = new CharEvaluator();
            return $carry + $charEvaluator->getCharValue($rucksack['doubled']);
        }, 0);

        echo 'SUM: ' . $sum . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }

}

sumRucksacks();