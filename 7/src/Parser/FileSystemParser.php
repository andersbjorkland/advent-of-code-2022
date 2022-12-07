<?php

declare(strict_types=1);

namespace Aoc7\Parser;

use Aoc7\FileSystem\AocFile;
use Aoc7\FileSystem\Directory;

class FileSystemParser
{
    const COMMAND_SIGN = '$';
    const CD_COMMAND = 'cd';
    const LS_COMMAND = 'ls';
    
    const CD_UP = '..';
    const CD_NONE = '.';
    
    const DIRECTORY_SIGN = 'dir';

    public function parse(string $fileContent): Directory
    {
        $rootDirectory = new Directory(name: '/', pwd: '/');
        
        $directoryMap = [];
        $directoryMap["/"] = $rootDirectory;
        $directoryMap["active"] = $rootDirectory;
        
        $directoryItems = explode("\n",$fileContent);
        $directoryItemsStack = $directoryItems;
        
        $commandItems = array_filter($directoryItems, fn ($item) => str_starts_with($item, self::COMMAND_SIGN));
        $lsItems = [];
        
        foreach ($commandItems as $commandItem) {
            $shiftedItem = array_shift($directoryItemsStack);

            $commandStructure = explode(' ', $commandItem);
            $command = $commandStructure[1];
            
            if ($command === self::CD_COMMAND) {
                $directoryMap = $this->handleCdCommand($directoryMap, $commandStructure);
            }
            
            if ($command === self::LS_COMMAND) {
                $count = count($directoryItemsStack);
                $lsIndexEnd = $count;
                for ($i = 0; $i < $count; $i++) {
                    if (str_starts_with($directoryItemsStack[$i], self::COMMAND_SIGN)) {
                        $lsIndexEnd = $i;
                        break;
                    }
                }
                $lsItems = array_splice($directoryItemsStack, 0, $lsIndexEnd);
                $activeDirectory = $directoryMap["active"];
                foreach ($lsItems as $lsItem) {
                    if (str_starts_with($lsItem, self::DIRECTORY_SIGN)) {
                        $directoryStructure = explode(' ', $lsItem);
                        $directoryName = $directoryStructure[1];
                        if (!$activeDirectory->hasDirectory($directoryName)) {
                            $newDirectory = new Directory($directoryName, false, $activeDirectory);
                            $activeDirectory->addDirectory($newDirectory);
                        }
                    } else {
                        $fileStructure = explode(' ', $lsItem);
                        $fileSize = (int)$fileStructure[0];
                        $fileName = $fileStructure[1];
                        if (!$activeDirectory->hasFile($fileName)) {
                            $newFile = new AocFile($fileName, $fileSize, $activeDirectory);
                            $activeDirectory->addFile($newFile);
                        }
                    }
                }
                
            }
        }
        
        return $rootDirectory;
    }
    
    protected function handleCdCommand(array $directoryMap, array $commandItems): array
    {
        /** @var Directory $previouslyActive */
        $previouslyActive = $directoryMap["active"];
        $dirName = $commandItems[2];

        switch($dirName) {
            case self::CD_UP:
                $parentDirectory = $previouslyActive->getParent();
                $currentlyActiveDirectory = $parentDirectory ?? $previouslyActive;
                $directoryMap["active"] = $currentlyActiveDirectory;
                $previouslyActive->setIsActive(false);
                $currentlyActiveDirectory->setIsActive(true);
                break;
            case self::CD_NONE:
                break;
            default:
                $currentlyActiveDirectory = $previouslyActive->getDirectoryByName($dirName) ?? $directoryMap["active"];
                $directoryMap["active"] = $currentlyActiveDirectory;
                $currentlyActiveDirectory->setIsActive(true);
                $previouslyActive->setIsActive(false);
                break;
        }
        
        return $directoryMap;
    }
    
    
}