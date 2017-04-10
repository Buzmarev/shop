<?php

class Admin {
    
    public static function verificationAdmin()
    {
        $user = User::verificationLogin();
        
        if($user['role'] == 'admin') return true;
        
        die('Access denied');
    }
    
    public static function getProductList()
    {
        $db = DB::getConnection();
        
        $product_list = array();
        $result = $db -> query('SELECT id, name, code, image, price, is_new FROM Product ORDER BY id ASC');
        
        for($i = 0; $row = $result -> fetch(); $i++){
            $product_list[$i]['id'] = $row['id'];
            $product_list[$i]['name'] = $row['name'];
            $product_list[$i]['code'] = $row['code'];
            $product_list[$i]['image'] = $row['image'];
            $product_list[$i]['price'] = $row['price'];
            $product_list[$i]['is_new'] = $row['is_new'];
        }
        
        return $product_list;
    }
    
    public static function deleteProduct($id)
    {
        $db = DB::getConnection();
        
        $sql = 'DELETE FROM product WHERE id = :id';
        
        $result = $db ->prepare($sql);
        $result ->bindParam(':id', $id, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    public static function createProduct($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        if ($result->execute()) return $db->lastInsertId();
        return 0;
    }
    
    public static function updateProduct($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    public static function updateProductImage($id)
    {
        $db = Db::getConnection();
        
        $result = $db -> query("UPDATE product SET image = '/template/images/product/{$id}.jpg' WHERE id = {$id}");
        
        return $result;
    }
    
    public static function deleteCategory($id)
    {
        $db = DB::getConnection();
        
        $sql = 'DELETE FROM category WHERE id = :id';
        
        $result = $db ->prepare($sql);
        $result ->bindParam(':id', $id, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    public static function createCategory($options)
    {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO category (name, sort_order, status)'
                . 'VALUES (:name, :sort_order, :status)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        if ($result->execute()) return $db->lastInsertId();
        return 0;
    }
    
    public static function updateCategory($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        return $result->execute();
    }
    
    public static function getOrderList()
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }
    
    public static function getStatusText($status)
    {
        if($status) return 'Отображается';
        else return 'Скрыта';
    }
    
    public static function getStatusTextOrder($status)
    {
        if($status == 1) return 'Новый заказ';
        else if($status == 2) return 'В обработке';
        else if($status == 3) return 'Доставляется';
        else if($status == 4) return 'Закрыт';
    }
    
    public static function deleteOrder($id)
    {
        $db = DB::getConnection();
        
        $sql = 'DELETE FROM product_order WHERE id = :id';
        
        $result = $db ->prepare($sql);
        $result ->bindParam(':id', $id, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    public static function getOrderSingle($id)
    {
        $db = DB::getConnection();
         
        $result = $db -> query("SELECT * FROM product_order WHERE id = $id");
        $result ->setFetchMode(PDO::FETCH_ASSOC);
        
        $order = $result -> fetch();
        
        return $order;
    }
    
    public static function updateOrder($id, $options)
    {
        $db = Db::getConnection();
        
        $sql = "UPDATE product_order
            SET 
                user_name = :userName, 
                user_phone = :userPhone, 
                user_comment = :userComment, 
                date = :date, 
                status = :status
            WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':userName', $options['userName'], PDO::PARAM_STR);
        $result->bindParam(':userPhone', $options['userPhone'], PDO::PARAM_STR);
        $result->bindParam(':userComment', $options['userComment'], PDO::PARAM_STR);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        
        return $result->execute();
    }
    
}
