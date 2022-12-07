<?php

declare(strict_types=1);

namespace Aoc7\FileSystem;

class Directory
{
    public function __construct(
        private string     $name, 
        private bool       $isActive = false,
        private ?Directory $parent = null, 
        private array      $directories = [],
        private array      $files = [],
        private ?string     $pwd = null
    ){
        if ($this->pwd === null) {
            if ($this->parent !== null) {
                $parentPwd = $this->parent->getPwd();
                $this->pwd = str_ends_with($parentPwd, '/') ? $parentPwd . $name : $parentPwd . '/' . $this->name; 
            } else {
                $this->pwd = '/' . $this->name;
            }
            
            $this->pwd = $this->pwd . '/';
        }
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return Directory|null
     */
    public function getParent(): ?Directory
    {
        return $this->parent;
    }

    /**
     * @param Directory|null $parent
     */
    public function setParent(?Directory $parent): void
    {
        $this->parent = $parent;
    }
    
    public function hasDirectory(string $name): bool
    {
        return $this->getDirectoryByName($name) !== null;
    }
    
    public function getDirectoryByName(string $name): ?Directory
    {
        $directories = array_filter($this->directories, fn ($directory) => $directory->getName() === $name);
        
        return array_shift($directories) ?? null;
    }
    
    public function hasFile(string $name): bool
    {
        return $this->getFileByName($name) !== null;
    }
    
    public function getFileByName(string $name): ?AocFile
    {
        $files = array_filter($this->files, fn ($file) =>  $file->getName() === $name);

        return $files[0] ?? null;
    }
    
    /**
     * @return Directory[]
     */
    public function getDirectories(): array
    {
        return $this->directories;
    }

    public function addDirectory(Directory $directory): void
    {
        if (!$this->hasDirectory($directory->getName())) {
            $this->directories[] = $directory;
        }
    }

    /**
     * @return AocFile[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }
    
    public function addFile(AocFile $file): void
    {
        $this->files[] = $file;
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd(string $pwd): void
    {
        $this->pwd = $pwd;
    }
    
    public function getTotalSize(): int
    {
        $totalSize = 0;
        
        /** @var Directory $directory */
        foreach ($this->directories as $directory) {
            $totalSize += $directory->getTotalSize();
        }
        
        /** @var AocFile $file */
        foreach ($this->files as $file) {
            $totalSize += $file->getSize();
        }

        return $totalSize;
    }
    
    public function __toString(): string
    {
        $level = 0;
        
        $matches = [];
        preg_match_all('/\//', $this->pwd, $matches);
        
        $level = count($matches[0]);
        
        $spaces = '';
        for ($i = 0; $i < $level; $i++) {
            $spaces .= ' ';
        }
        
        $stringStructure = '- ' . $this->name . ' (dir, size= ' . $this->getTotalSize() . ')' . PHP_EOL;
        
        /** @var Directory $directory */
        foreach ($this->directories as $directory) {
            $stringStructure .= $spaces . $directory . PHP_EOL;
        }
        
        /** @var AocFile $file */
        foreach ($this->files as $file) {
            $stringStructure .= $spaces . $file . PHP_EOL;
        }
        
        $stringStructure = rtrim($stringStructure);
        
        return $stringStructure;
    }

}