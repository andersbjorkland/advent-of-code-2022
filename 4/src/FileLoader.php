<?php

declare(strict_types=1);

namespace Aoc4;

class FileLoader
{
    const DOUBLE_LINE_PARSER = 0;
    const SECTIONS_PARSER = 1;

    public function __construct(
        private int $parser = self::DOUBLE_LINE_PARSER,
    ){}

    public function readFile($file): array
    {
        $fileContents = file_get_contents($file);

        return match($this->parser) {
            self::DOUBLE_LINE_PARSER => $this->doubleLineParser($fileContents),
            self::SECTIONS_PARSER => $this->sectionsParser($fileContents),
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

    /**
     * @param string $fileContents
     * @return array|SectionPair[]
     */
    protected function sectionsParser(string $fileContents): array
    {
        $content = explode("\n", $fileContents);

        $sectionPairs = [];
        foreach ($content as $sections) {
            $sectionPair = new SectionPair();
            $elfSections = explode(',', $sections);
            foreach ($elfSections as $rawSection) {
                $parsedRawSection = explode('-', $rawSection);
                $section = new Section((int)$parsedRawSection[0], (int)$parsedRawSection[1]);
                $sectionPair->addSection($section);
            }
            $sectionPairs[] = $sectionPair;
        }

        return $sectionPairs;
    }
}