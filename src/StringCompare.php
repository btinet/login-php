<?php

namespace App;

class StringCompare
{

    private array $words = array('Apfel','Wein','Brot','Banane', 'Benjamin','Lutz','Schmutz','Vieh','Informatik','Mathematik','Gurke');

    public function findDistance(string $input): string
    {

        $shortest = -1;


        foreach ($this->words as $word) {

            // berechne die Distanz zwischen Inputwort und aktuellem Wort
            $lev = levenshtein($input, $word);

            // auf einen exakten Treffer prüfen
            if ($lev == 0) {

                // das nächste Wort ist das Wort selbst (exakter Treffer)
                $closest = $word;
                $shortest = 0;

                // Schleife beenden, da wir einen exakten Treffer gefunden haben
                break;
            }

            // Wenn die Distanz kleiner ist als die nächste gefundene kleinste Distanz
            // ODER wenn ein nächstkleineres Wort noch nicht gefunden wurde
            if ($lev <= $shortest || $shortest < 0) {
                // setze den nächstliegenden Treffer und die kürzestes Distanz
                $closest  = $word;
                $shortest = $lev;
            }
        }

        if ($shortest == 0) {
            return "Exakter Treffer gefunden: $closest\n";
        } else {
            return "Meinten Sie: $closest?\n";
        }
    }


}