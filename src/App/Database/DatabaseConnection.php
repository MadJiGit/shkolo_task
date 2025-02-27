<?php
namespace App\Database;

use App\Interfaces\DatabaseInterface;

class DatabaseConnection implements DatabaseInterface
{
    private static ?\mysqli $connection = null;
    /**
     * @throws \Exception
     */
    public static function getConnection(): \mysqli
    {
        if (self::$connection === null) {

            self::$connection = new \mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

            if (self::$connection->connect_error) {
                throw new \Exception('Connection failed: ' . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }
}