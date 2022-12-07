<?php

declare(strict_types=1);

namespace Aoc7\FileSystem;

class AocFile
{
    public function __construct(
        private string $name,
        private int $size,
        private ?Directory $directory = null
    ){}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return Directory|null
     */
    public function getDirectory(): ?Directory
    {
        return $this->directory;
    }

    /**
     * @param Directory|null $directory
     */
    public function setDirectory(?Directory $directory): void
    {
        $this->directory = $directory;
    }
    
    public function __toString(): string
    {
        return "- " . $this->name . " (file, size=" . $this->size . ")";
    }
    
    

}