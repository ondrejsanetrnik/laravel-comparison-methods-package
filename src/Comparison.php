<?php

namespace Ondrejsanetrnik\LaravelComparisonMethods;

use Ondrejsanetrnik\Helper\Helper;

class Comparison
{
    /**
     * Compares the similarity of two strings
     *
     * @param string $str1
     * @param string $str2
     * @param int $base
     * 
     * @return int
     * 
     */
    public static function string(
        string $str1,
        string $str2,
        int $base = 100
    ): int {
        $str1 = Helper::convertToSlug($str1);
        $str2 = Helper::convertToSlug($str2);

        # Exact match
        if ($str1 == $str2) return $base;

        similar_text($str1, $str2, $perc);
        $similarity = ($base / 2) * pow($perc / 100, 2);
        return round($similarity);
    }

    /**
     * Compares the similarity of two ints
     *
     * @param int|null $int1
     * @param int|null $int2
     * @param int $base
     * 
     * @return int
     * 
     */
    public static function int(
        int $int1 = null,
        int $int2 = null,
        int $base = 100
    ): int {
        # None of the inputs was provided, which is somehow similar
        if (!$int1 && !$int2) return round($base * 2 / 3);

        # Exact match
        if ($int1 == $int2) return $base;

        $difference = abs($int1 - $int2);
        $similarity = max($base * 1 / 3 - pow($difference, 2.4), 0);
        return round($similarity);
    }
}
