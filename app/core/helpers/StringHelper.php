<?php

namespace core\helpers;

class StringHelper implements HelperInterface
{

    /**
     * Truncates a string to the number of characters specified.
     *
     * @param string $string The string to truncate.
     * @param int $length How many characters from original string to include into truncated string.
     * @param string $suffix String to append to the end of truncated string.
     * @param string $encoding The charset to use, defaults to charset currently used by application..
     * @return string the truncated string.
     */
    public static function truncate($string, $length, $suffix = '...', $encoding = null)
    {
        if ($encoding === null) {
            $encoding = 'UTF-8';
        }

        if (mb_strlen($string, $encoding) > $length) {
            return rtrim(mb_substr($string, 0, $length, $encoding)) . $suffix;
        }

        return $string;
    }
}