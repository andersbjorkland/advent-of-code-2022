<?php

function sum(array $array)
{
    $sum = 0.0;

    try {
        $i = 0;
        while(true) {
            $value = $array[$i] ?? throw new \Exception('' . $sum);
            $sum += $value;
            $i++;
        }
    } catch (Exception $e) {
        return (float)$e->getMessage();
    }
}

$values = [3, 2.5, 0.5];
echo 'Sum of ' . implode(' + ', $values) . ' = ' . sum($values) . PHP_EOL;