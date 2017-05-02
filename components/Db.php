<?php

/**
 * Соединение с БД
 */
class Db {
    
    public static function getConnection(){
        
        $dsn = 'mysql:host=localhost;dbname=guestbook';
        
        try{
            $pdo = new PDO($dsn, 'root', '');
            return $pdo;
        } catch (PDOException $ex) {
            exit($ex->getMessage());
        }
    }
}
