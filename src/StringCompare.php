<?php

namespace App;

use PDO;
use PDOException;
use PDOStatement;

class StringCompare
{

    private array $words = array('Apfel','Wein','Brot','Banane', 'Benjamin','Lutz','Schmutz','Vieh','Informatik','Mathematik','Gurke');
    private PDO $pdo;
    private PDOStatement $query;

    public function __construct()
    {
        try {
            // Datenbankverbindung herstellen
            $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=thes','root');
// SQL-Query aufschreiben
            $sqlQuery = 'select baseform from word_mapping';
// Query ausführen und Ergebnisse zwischenspeichern
            $this->query = $this->pdo->query($sqlQuery);
        } catch (PDOException $exception) {
            die('Es hat was nicht geklappt!');
        }

    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function findDistance(string $input): string
    {

        $shortest = -1;
        $closest = '';

        foreach ($this->query as $row) {

            $word = $row['baseform'];
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

        /**
         * if ($shortest == 0) {
        return Treffer $closest;
        } else {
        return Ähnlichkeit $closest;
        }
         */
        return $closest;
    }


}