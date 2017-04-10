<?php

class BasketController {
    
    public function actionIndex()
    {
        $products = Basket::getProducts();
        
        $sum = Basket::getSum($products);
        
        require_once ROOT. '/views/basket/index.php';
        
        return true;
    }
    
    public function actionAdd($id)
    {
        Basket::addProduct($id);
        
        $path = $_SERVER['HTTP_REFERER'];
        header("Location: $path");
    }
    
    public function actionDelete($id)
    {
        Basket::deleteProduct($id);
        
        $path = $_SERVER['HTTP_REFERER'];
        header("Location: $path");
    }
    
    public function actionDrop($id)
    {
        Basket::dropProduct($id);
        
        $path = $_SERVER['HTTP_REFERER'];
        header("Location: $path");
    }
    
    public function actionCheckout()
    {
        $products = Basket::getProducts();
        
        if($products == false) header('Location: /');
        
        $sum = Basket::getSum($products);
        $count = Basket::countProduct();
        $name = false;
        $phone = false;
        $comment = false;
        $result = false;
        $user = false;
        
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $name = $user['name'];
        }
        
        if(isset($_POST['submit'])){
            
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];
            
            $errors = false;
            
            if(!User::verificationName($name))
                $errors[] = 'В имени должно быть хотя бы два симола';
            if(!User::verificationPhone($phone))
                $errors[] = 'Телефон введен некорректно';
            
            if($errors == false){
                $result = Basket::Save($name, $phone, $comment, $user, $products);
                
                if($result) Basket::Clear();
            }
        }
        
        require_once ROOT. '/views/basket/checkout.php';
        
        return true;
    }
    
}
