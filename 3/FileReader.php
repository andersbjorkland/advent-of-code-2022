<?php

declare(strict_types=1);

class FileReader
{
    public function readFileToArray(string $file, callable|null $callback = null): array
    {
        $file = file_get_contents(__DIR__ . '/' . $file);
        return $callback === null ? $this->defaultParser($file) : $callback($file);
    }

    protected function defaultParser($file): array
    {
        return $this->rucksackParser($file);
    }

    protected function rucksackParser($file): array
    {
        $rucksacks = [];
        $content = explode("\n", $file);
        foreach ($content as $item) {
            $arr = str_split($item);
            $count = count($arr);
            $wholeIndex = [];
            $doubledChar = '';

            $halfwayIndex = (int)floor($count/2);
            $firstSection = array_slice($arr, 0, $halfwayIndex);
            $secondSection = array_slice($arr, $halfwayIndex);

            foreach ($firstSection as $char) {
                if (!array_key_exists($char, $wholeIndex)) {
                    $wholeIndex[$char] = [];
                    $wholeIndex[$char][0] = 0;
                }

                $wholeIndex[$char][0] += 1;
            }

            foreach ($secondSection as $char) {
                if (!array_key_exists($char, $wholeIndex)) {
                    $wholeIndex[$char] = [];
                }

                if (!array_key_exists(1, $wholeIndex[$char])) {
                    $wholeIndex[$char][1] = 0;
                }

                if (array_key_exists(0, $wholeIndex[$char])) {
                    $doubledChar = $char;
                }

                $wholeIndex[$char][1] += 1;
            }

            $rucksacks[] = [
                'first' => $firstSection,
                'second' => $secondSection,
                'doubled' => $doubledChar,
                'whole' => $wholeIndex
            ];
        }

        return $rucksacks;
    }

    protected function doubleLineParser($file): array
    {
        $content = explode("\n\n", $file);

        $content = array_map(function ($data) {

            $items = explode("\n", $data);

            $result = [];
            foreach ($items as $item) {
                if ($item === "") {
                    continue;
                }

                $result[] = (int)$item;
            }

            return $result;
        }, $content);

        return $content;
    }

}