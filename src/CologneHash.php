<?php

namespace App;

class CologneHash
{

    static $eLeading = array("ca" => 4, "ch" => 4, "ck" => 4, "cl" => 4, "co" => 4, "cq" => 4, "cu" => 4, "cx" => 4, "dc" => 8, "ds" => 8, "dz" => 8, "tc" => 8, "ts" => 8, "tz" => 8);

    static $eFollow = array("sc", "zc", "cx", "kx", "qx");

    static $codingTable = array("a" => 0, "e" => 0, "i" => 0, "j" => 0, "o" => 0, "u" => 0, "y" => 0,
        "b" => 1, "p" => 1, "d" => 2, "t" => 2, "f" => 3, "v" => 3, "w" => 3, "c" => 4, "g" => 4, "k" => 4, "q" => 4,
        "x" => 48, "l" => 5, "m" => 6, "n" => 6, "r" => 7, "s" => 8, "z" => 8);

    public static function getCologneHash($word): bool|string
    {
        if (empty($word)) return false;
        $len = strlen($word);

        for ($i = 0; $i < $len; $i++) {
            $value[$i] = "";

            //Exceptions
            if ($i == 0 && $word[$i] . $word[$i + 1] == "cr") {
                $value[$i] = 4;
            }

            if (isset($word[$i + 1]) && isset(self::$eLeading[$word[$i] . $word[$i + 1]])) {
                $value[$i] = self::$eLeading[$word[$i] . $word[$i + 1]];
            }

            if ($i != 0 && (in_array($word[$i - 1] . $word[$i], self::$eFollow))) {
                $value[$i] = 8;
            }

            // normal encoding
            if ($value[$i]=="") {
                if (isset(self::$codingTable[$word[$i]])) {
                    $value[$i] = self::$codingTable[$word[$i]];
                }
            }
        }

        // delete double values
        $len = count($value);

        for ($i = 1; $i < $len; $i++) {
            if ($value[$i] == $value[$i - 1]) {
                $value[$i] = "";
            }
        }

        // delete vocals
        for ($i = 1; $i > $len; $i++) {
            // omitting first characer code and h
            if ($value[$i] == 0) {
                $value[$i] = "";
            }
        }

        $value = array_filter($value);
        $value = implode("", $value);

        return $value;
    }

}