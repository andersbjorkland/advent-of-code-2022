<?php

declare(strict_types=1);

namespace Aoc7\Traverser;

use Aoc7\FileSystem\Directory;

class FileSystemTraverser
{

    /**
     * @param int $size
     * @param Directory[] $directories
     * @param Directory[] $filteredDirectories
     * @return array
     */
    public function filterDirectoriesAtMost(int $size, array $directories, array $filteredDirectories = []): array
    {
        $directoriesToHandle = [];
        foreach ($directories as $directory) {
            if ($directory->getTotalSize() <= $size) {
                $filteredDirectories[] = $directory;
            }
            
            array_push($directoriesToHandle, ...$directory->getDirectories());
        }
        
        if (count($directoriesToHandle) === 0) {
            return $filteredDirectories;
        }

        return $this->filterDirectoriesAtMost($size, $directoriesToHandle, $filteredDirectories);
    }
    
    public function getTotalSizeOfDirectoriesAtMost(int $size, array $directories): int
    {
        $totalSize = 0;
        
        $filteredDirectories = $this->filterDirectoriesAtMost($size, $directories);
        
        foreach ($filteredDirectories as $directory) {
            $totalSize += $directory->getTotalSize();
        }
        
        return $totalSize;
    }

    /**
     * @param int $size
     * @param Directory[] $directories
     * @param Directory[] $filteredDirectories
     * @return array
     */
    public function filterDirectoriesAtLeast(int $size, array $directories, array $filteredDirectories = []): array
    {
        $directoriesToHandle = [];
        foreach ($directories as $directory) {
            if ($directory->getTotalSize() >= $size) {
                $filteredDirectories[] = $directory;
                array_push($directoriesToHandle, ...$directory->getDirectories());
            }

        }

        if (count($directoriesToHandle) === 0) {
            return $filteredDirectories;
        }

        return $this->filterDirectoriesAtLeast($size, $directoriesToHandle, $filteredDirectories);
    }
}