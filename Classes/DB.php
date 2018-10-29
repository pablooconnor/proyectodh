<?php

class DB {

    public static function Connect() 
    {
        // $dsn = 'mysql:host=127.0.0.1;dbname=panu_db;port=3306;charset=utf8mb4';
        $dsn = 'mysql:host=127.0.0.1;dbname=panu_db;port=8889;charset=utf8mb4';
        $db_user = 'root';
        // $db_user = '';
        $db_pass = 'root';
        $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    
        try { 
            return $pdo = new PDO($dsn, $db_user, $db_pass, $opt);
        } catch(PDOException $error) {
            $errores = $error->getMessage();
            return $errores;
        }
    }

}

