<?php

class CabinetController {
    
    public function actionIndex()
    {
        $user = User::verificationLogin();
        
        require_once ROOT. '/views/cabinet/index.php';
        
        return true;
    }
    
    public function actionEdit()
    {
        $user = User::verificationLogin();
        
        $name = $user['name'];
        $password = $user['password'];
        $result = false;
        
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if(!User::verificationName($name))
                $errors[] = 'В имени должно быть хотя бы два симола';
            if(!User::verificationPassword($password))
                $errors[] = 'Пароль должен состоять хотя бы из шести символов';
            
            if($errors == false){
                $result = User::Edit($user['id'], $name, $password);
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['password'] = $password;
            }
        }
        
        require_once ROOT. '/views/cabinet/edit.php';
    }
    
}
