<?php

namespace Quiz\Service;

require_once './vendor/autoload.php';


use \Laminas\Db\Adapter\Adapter;


class DB
{
    private static $adapter = null;


    public static function getAdapter()
    {

        if (is_null(self::$adapter)) {
            $host = '127.0.0.1';
            $db   = 'quiz_project';
            $user = 'root';
            $pass = '7598';
            $charset = 'utf8';

            self::$adapter = new Adapter([
                'dsn' => "mysql:host=$host;dbname=$db;charset=$charset", // DB_NAME is from WRKRDBDIRE, may be serial #
                'driver' => 'pdo',
                'driver_options' => [
                    // PDO::ATTR_PERSISTENT => true,
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES   => false,
                ],
                'database' => 'laminas',
                'username' => 'root',
                'password' => '7598',

            ]);
        }

        return self::$adapter;
    }
}
