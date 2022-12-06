<?php

declare(strict_types=1);

namespace Test6;

use Aoc6\DataPacketIdentifier;

class DataPacketIdentifierTest extends \PHPUnit\Framework\TestCase
{
    public function testIdentifyMarker(): void
    {
        $dataPackerIdentifier = new DataPacketIdentifier();
        
        $marker = 'pqmg';
        
        $actual = $dataPackerIdentifier->identifyMarker($marker);
        
        $this->assertTrue($actual);
    }
    
    public function testDoNotIdentifyMarkerForNonMarker(): void
    {
        $dataPackerIdentifier = new DataPacketIdentifier();

        $nonMarker = 'mjqj';

        $actual = $dataPackerIdentifier->identifyMarker($nonMarker);

        $this->assertNotTrue($actual);
    }
    
    public function testFindIndexOfMarkStart(): void
    {

        $dataPackerIdentifier = new DataPacketIdentifier();

        $stream1 = "mjqjpqmgbljsphdztnvjfqwrcgsmlb";
        $index1 = $dataPackerIdentifier->findMarkerInStream($stream1);

        $this->assertEquals(7, $index1);

        
        $stream2 = "zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw";
        $index2 = $dataPackerIdentifier->findMarkerInStream($stream2);

        $this->assertEquals(11, $index2);
    }
    
    public function testFindMessageIndexInStream(): void
    {
        $dataPackerIdentifier = new DataPacketIdentifier();
        
        $stream1 = "mjqjpqmgbljsphdztnvjfqwrcgsmlb";
        $messageIndex1 = $dataPackerIdentifier->findMarkerInStream($stream1, 14);

        $stream2 = "nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg";
        $messageIndex2 = $dataPackerIdentifier->findMarkerInStream($stream2, 14);

        $stream3 = "nppdvjthqldpwncqszvftbrmjlhg";
        $messageIndex3 = $dataPackerIdentifier->findMarkerInStream($stream3, 14);


        $this->assertEquals(19, $messageIndex1);
        $this->assertEquals(29, $messageIndex2);
        $this->assertEquals(23, $messageIndex3);
    }
    
}