<?php

namespace App;

class Connection {

    public static function getDb() {
        try {
            $conn = new \PDO(
                "mysql:host=localhost;dbname=phone_store;charset=utf8",
                "root",
                "P@ssw0rd"
            );

            return $conn;
        } catch (\PDOException $e) {
            echo 'Erro'.$e;
        }
    }
}