<?php

namespace App\Data;

use PDO;

class DbContext {
    private static PDO $context;

    public static function Get(): PDO {
        if (DbContext::$context != null) {
            return DbContext::$context;
        }
        $userName = $_ENV["DB_USERNAME"];
        $password = $_ENV["DB_PASSWORD"];
        $dbName = $_ENV["DB_NAME"];
        $dbProvider = $_ENV["DB_PROVIDER"];
        $dbHost = $_ENV["DB_HOST"];
        $dbCharset = $_ENV["DB_CHARSET"];
        $connectionString = "{$dbProvider}:host={$dbHost};dbname={$dbName};charset={$dbCharset}";
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