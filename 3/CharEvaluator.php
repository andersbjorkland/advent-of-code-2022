<?php

declare(strict_types=1);

class CharEvaluator
{
    const LOWER_CHAR_VALUE_OFFSET = -96;
    const UPPER_CHAR_VALUE_OFFSET = -38;
    const UPPERCASE_UPPER_LIMIT = 90;

    /**
     * @throws Exception
     */
    function getCharValue(string $char): int
    {
        if (strlen($char) > 1) {
            throw new Exception('A string longer than 1 is not accepted');
        }

        $value = ord($char);
        $offset = $value <= self::UPPERCASE_UPPER_LIMIT ? self::UPPER_CHAR_VALUE_OFFSET : self::LOWER_CHAR_VALUE_OFFSET;
        return $value + $offset;
    }
}