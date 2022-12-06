<?php

declare(strict_types=1);

namespace Aoc6;

class DataPacketIdentifier
{
    public function identifyMarker(string $packet): bool
    {
        $uniqueChars = '';
        $chars = str_split($packet);
        foreach ($chars as $char) {
            if (strpos($uniqueChars, $char) === false) {
                $uniqueChars .= $char;
            } 
        }
        
        return strlen($uniqueChars) === strlen($packet);
    }

    /**
     * @throws \Exception
     */
    public function findMarkerInStream(string $stream, $packetLength = 4): int
    {
        $markerStart = -1;
        
        $streamLength = strlen($stream);
        for ($packetEnd = $packetLength; $packetEnd < $streamLength; $packetEnd++) {
            $packetStart = $packetEnd - $packetLength;
            $packet = substr($stream, $packetStart, $packetLength);
            if ($this->identifyMarker($packet)) {
                $markerStart = $packetEnd;
                break;
            }
        }
        
        if ($markerStart === -1) {
            throw new \Exception("Marker was not found!");
        }
        
        return $markerStart;
    }
    
    
}