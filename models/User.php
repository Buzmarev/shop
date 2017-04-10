<?php

class User {
    
    public static function Register($name, $email, $password, $role = '')
    {
        $db = DB::getConnection();
        
        $sql = 'INSERT INTO user (name, email, password, role) '
                . 'VALUES(:name, :email, :password, :role)';
        
        $result = $db -> prepare($sql);
        $result ->bindParam(':name', $name, PDO::PARAM_STR);
        $result ->bindParam(':email', $email, PDO::PARAM_STR);
        $result ->bindParam(':password', $password, PDO::PARAM_STR);
        $result ->bindParam(':role', $role, PDO::PARAM_STR);
        
        return $result -> execute();
    }
    
    public static function verificationName($name)
    {
        if(strlen($name) < 2) return false;
        
        return true;
    }
    
    public static function verificationPhone($phone)
    {
        if(!preg_match('~^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$~', $phone)) return false;
        
        return true;
    }
    
    public static function verificationEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        
        return true;
    }
    
    public static function verificationPassword($password)
    {
        if(strlen($password) < 6) return false;
        
        return true;
    }
    
    public static function verificationEmailExist($email)
    {
        $db = DB::getConnection();
        
        $result = $db -> query("SELECT count(id) AS count FROM user "
                . "WHERE email = '$email'");
        $result ->setFetchMode(PDO::FETCH_ASSOC);
        
        $result = $result -> fetch();
        
        if (!$result['count']) return false;
        
        return true;
    }
    
    public static function verificationUser($email, $password)
    {
        $db = DB::getConnection();
        
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        
        $result = $db ->prepare($sql);
        $result ->bindParam(':email', $email, PDO::PARAM_STR);
        $result ->bindParam(':password', $password, PDO::PARAM_STR);
        $result ->execute();
        
        $user = $result ->fetch();
        
        if($user) return $user;
        return false;
    }
    
    public static function auth($user)
    {
        $_SESSION['user'] = $user;
    }
    
    public static function verificationLogin()
    {
        if(isset($_SESSION['user'])) return $_SESSION['user'];
        
        header('Location: /user/login');
    }
    
    public static function Edit($id, $name, $password)
    {
        $db = DB::getConnection();
        
        $sql = 'UPDATE user SET name = :name, password = :password WHERE id = :id';
        
        $result = $db ->prepare($sql);
        $result ->bindParam(':id', $id, PDO::PARAM_STR);
        $result ->bindParam(':name', $name, PDO::PARAM_STR);
        $result ->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result ->execute();
    }
    
}
