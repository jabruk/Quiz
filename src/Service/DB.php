<?php

namespace Quiz\Service;

class DB 
{
    private static $pdo = null;


    public static function get(){

        if(is_null(self::$pdo)){
            $host = '127.0.0.1';
            $db   = 'quiz_project';
            $user = 'root';
            $pass = '7598';
            $charset = 'utf8';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $opt = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            #Подключение к БД
            self::$pdo = new \PDO($dsn, $user, $pass, $opt);


        }

        return self::$pdo;


    }

}