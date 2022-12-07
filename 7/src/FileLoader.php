<?php

declare(strict_types=1);

namespace Aoc5;

use Aoc5\Parser\StackInstructionParser;

class FileLoader
{
    const DOUBLE_LINE_PARSER = 0;

    public function __construct(
        private int $parser = self::DOUBLE_LINE_PARSER,
    ){}

    public function readFile($file): array
    {
        $fileContents = file_get_contents($file);

        return match($this->parser) {
            self::DOUBLE_LINE_PARSER => $this->doubleLineParser($fileContents),
            default => $this->defaultParser($fileContents)
        };
    }

    protected function defaultParser(string $fileContents): array
    {
        return $this->doubleLineParser($fileContents);
    }

    protected function doubleLineParser(string $fileContents): array
    {
        $content = explode("\n\n", $fileContents);

        $content = array_map(function ($data) {

            $items = explode("\n", $data);

            $result = [];
            foreach ($items as $item) {
                if ($item === "") {
                    continue;
                }

                $result[] = $item;
            }

            return $result;
        }, $content);

        return $content;
    }
}