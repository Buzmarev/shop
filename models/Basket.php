<?php

class Basket {
    
    public static function getProducts()
    {
        if(isset($_SESSION['basket'])){
            
            $products = false;
            
            foreach($_SESSION['basket'] as $id => $quantity){
                $prod = Product::getProductSingle($id);
                $products[$id]['image'] = $prod['image'];
                $products[$id]['id'] = $prod['id'];
                $products[$id]['name'] = $prod['name'];
                $products[$id]['code'] = $prod['code'];
                $products[$id]['price'] = $prod['price'];
                $products[$id]['quantity'] = $quantity;
            }
             
            return $products; 
            
        } else return false;
    }
    
    public static function addProduct($id)
    {
        $id = intval($id);
        
        $basket = array();

        if(isset($_SESSION['basket']))
           $basket = $_SESSION['basket'];
    
        if(array_key_exists($id, $basket))
            $basket[$id] ++;
        else 
            $basket[$id] = 1;
    
        $_SESSION['basket'] = $basket;
        echo '<pre>';
        print_r($_SESSION['basket']);
    }
    
    public static function deleteProduct($id)
    {
        $id = intval($id);
        
        $basket = array();

        if(isset($_SESSION['basket']))
           $basket = $_SESSION['basket'];
    
        if(array_key_exists($id, $basket)){
            if($basket[$id] == 0) $basket[$id] = 0;
            else $basket[$id] --;
        }
            
        $_SESSION['basket'] = $basket;
    }
    
    public static function dropProduct($id)
    {
        $id = intval($id);
        
        $basket = array();

        if(isset($_SESSION['basket']))
           unset($_SESSION['basket'][$id]);
    
    }
    
    public static function countProduct()
    {
        $count = 0;
        if(isset($_SESSION['basket'])){
            foreach($_SESSION['basket'] as $id => $quantity){
                $count += $quantity;
            }
        }
        return $count;
    }
    
    public static function getSum($products)
    {
        $sum = 0;
        
        if($products){
            foreach($products as $id => $prod){
                $sum += $prod['price'] * $prod['quantity'];
            }
        }
        
        return $sum;
    }
    
    public static function Save($name, $phone, $comment, $user, $products)
    {
        $db = DB::getConnection();
        
        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:name, :phone, :comment, :id, :products)';
        
        $products = json_encode($products);
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        $result->bindParam(':comment', $comment, PDO::PARAM_STR);
        $result->bindParam(':id', $user['id'], PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    public static function Clear()
    {
        if(isset($_SESSION['basket'])) unset($_SESSION['basket']);
    }
    
}
