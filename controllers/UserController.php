<?php

class UserController {
    
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if(!User::verificationName($name))
                $errors[] = 'В имени должно быть хотя бы два симола';
            if(!User::verificationEmail($email))
                $errors[] = 'Неправильный Email';
            if(!User::verificationPassword($password))
                $errors[] = 'Пароль должен состоять хотя бы из шести символов';
            if(User::verificationEmailExist($email))
                $errors[] = 'Такой Email уже существует';
            
            if($errors == false)
                $result = User::Register($name, $email, $password);
        }
        
        require_once ROOT. '/views/user/register.php';
        
        return true;
    }
    
    public function actionLogin()
    {
        $email = '';
        $password = '';
        
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if(!User::verificationEmail($email))
                $errors[] = 'Неправильный Email';
            if(!User::verificationPassword($password))
                $errors[] = 'Пароль должен состоять хотя бы из шести символов';
//          
            $user = User::verificationUser($email, $password);
            
            if($user == false)
                $errors[] = 'Такого пользователя не существует';
            else{
                User::auth($user);
            
                header('Location: /cabinet/');
            }
        }
        
        require_once ROOT. '/views/user/login.php';
        
        return true;
    }
    
    public static function actionLogout()
    {
        unset($_SESSION['user']);
        
        header('Location: /');
    }
    
}
