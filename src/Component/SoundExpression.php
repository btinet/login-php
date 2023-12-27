<?php

namespace App\Component;

class SoundExpression
{

    public static function compareSound(string $a, string $b): bool
    {
        echo PHP_EOL . soundex($a). ' und ' . soundex($b) . PHP_EOL;
        return soundex($a) == soundex($b);
    }

    public static function compareText(string $a, string $b, &$percentage)
    {
        $result = similar_text($a, $b, $percentage);
    }

}