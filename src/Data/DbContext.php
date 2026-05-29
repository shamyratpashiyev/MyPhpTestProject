<?php

namespace App\Data;

use PDO;

class DbContext {
    private static PDO $context;

    public static function Get(): PDO {
        if (DbContext::$context != null) {
            return DbContext::$context;
        }
        $connectionString = $_ENV["DB_CONNECTION_STRING"];
        $userName = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        DbContext::$context = new PDO($connectionString, $userName, $password, $options);
        return DbContext::$context;
    }

    public static function ExecuteRawSql(string $query) {
        $context = DbContext::Get();
        $context->exec($query);
    }
}