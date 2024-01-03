<?php

namespace App\Database;

use PDO;

class MySQLConnection extends PDO
{

    /**
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string|null $password
     * @param int $port
     * @param string $type
     */
    public function __construct(string $host, string $db, string $user, string $password = null, int $port = 3306, string $type = 'mysql')
    {
        $dsn = sprintf("%s:host=%s;port=%s;dbname=%s",$type,$host,$port,$db);
        parent::__construct($dsn,$user,$password);
    }

    /**
     * @param array $columns Array mit Spalten, die ausgewählt werden sollen.
     * @param string $table Tabelle, in der nach Datensätzen gesucht werden soll.
     * @param string|null $condition Bedingung, nach der gesucht werden soll (ohne WHERE).
     * @return bool|array Gibt Array mit allen gefundenen Datensätzen oder false zurück.
     */
    public function select(array $columns, string $table, string $condition = null): bool|array
    {
        $columns = implode(",",$columns);

        if($condition) {
            $condition = sprintf("WHERE %s",$condition);
        }

        $query = sprintf("SELECT %s FROM %s %s LIMIT 0,10",$columns,$table,$condition);

        return $this->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

}