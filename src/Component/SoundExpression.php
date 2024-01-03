<?php

namespace App\Component;

use PDO;

class SoundExpression
{
    public static function compare($word, PDO $pdo): string
    {
        $sqlQuery = 'select baseform from word_mapping';
        $query = $pdo->query($sqlQuery);

        foreach ($query as $entry) {
            if(self::compareSound($word,$entry['baseform'])) {
                return $entry['baseform'];
            }
        }
        return 'Es klingt nichts so ähnlich wie ' . $word;
    }

    public static function compareSound(string $a, string $b): bool
    {
        return soundex($a) == soundex($b);
    }

    public static function compareText(string $a, string $b, &$percentage)
    {
        $result = similar_text($a, $b, $percentage);
    }

}