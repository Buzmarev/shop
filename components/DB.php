<?php

class DB {
    public static function getConnection()
    {
        $host = 'localhost';
        $dbname = 'phpshop';
        $user = 'root';
        $password = '';
        
        $db = new PDO ("mysql:host=$host; dbname=$dbname", $user, $password);
        
        return $db;
    }
}
