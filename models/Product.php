<?php

class Product {
    
    public static function getProductList($count, $page)
    {
        $db = DB::getConnection();
        
        $offset = ($page - 1) * $count;
        
        $product_list = array();
        $result = $db -> query('SELECT id, name, image, price, is_new FROM Product '
                               . 'WHERE status = "1" '
                               . 'ORDER BY id DESC '
                               . 'LIMIT '. $count
                               . ' OFFSET '. $offset);
        
        for($i = 0; $row = $result -> fetch(); $i++){
            $product_list[$i]['id'] = $row['id'];
            $product_list[$i]['name'] = $row['name'];
            $product_list[$i]['image'] = $row['image'];
            $product_list[$i]['price'] = $row['price'];
            $product_list[$i]['is_new'] = $row['is_new'];
        }
        
        return $product_list;
    }
    
    public static function getProductRecommended()
    {
        $db = Db::getConnection();
        
        $result = $db->query('SELECT id, name, image, price, is_new FROM product '
                . 'WHERE status = "1" AND is_recommended = "1" '
                . 'ORDER BY id DESC');
        
        for($i = 0; $row = $result -> fetch(); $i++){
            $product_list[$i]['id'] = $row['id'];
            $product_list[$i]['name'] = $row['name'];
            $product_list[$i]['image'] = $row['image'];
            $product_list[$i]['price'] = $row['price'];
            $product_list[$i]['is_new'] = $row['is_new'];
        }
        
        return $product_list;
    }
    
    public static function getProductListbyCategory($category, $count = 9, $page)
    {
        $db = DB::getConnection();
        
        $offset = ($page - 1) * $count;
        
        $product_list = array();
        $result = $db -> query("SELECT id, name, image, price, is_new FROM Product "
                               . "WHERE status = '1' and category_id = '$category' "
                               . "ORDER BY id DESC "
                               . "LIMIT ". $count
                               . " OFFSET ". $offset);
        
        for($i = 0; $row = $result -> fetch(); $i++){
            $product_list[$i]['id'] = $row['id'];
            $product_list[$i]['name'] = $row['name'];
            $product_list[$i]['image'] = $row['image'];
            $product_list[$i]['price'] = $row['price'];
            $product_list[$i]['is_new'] = $row['is_new'];
        }
        
        return $product_list;
    }
    
    public static function getProductSingle($id)
    {
        $db = DB::getConnection();
         
        $result = $db -> query("SELECT * FROM Product WHERE id = $id");
        $result ->setFetchMode(PDO::FETCH_ASSOC);
        
        $product_id = $result -> fetch();
        
        return $product_id;
    }
    
    public static function getTotalProduct($category)
    {
        $db = DB::getConnection();
         
        $result = $db -> query("SELECT count(id) AS count FROM Product "
                . "WHERE status = '1' and category_id = '$category'");
        $result ->setFetchMode(PDO::FETCH_ASSOC);
        
        $total = $result -> fetch();
        
        return $total['count'];
    }
    
    public static function getTotalProductAll()
    {
        $db = DB::getConnection();
         
        $result = $db -> query("SELECT count(id) AS count FROM Product "
                . "WHERE status = '1'");
        $result ->setFetchMode(PDO::FETCH_ASSOC);
        
        $total = $result -> fetch();
        
        return $total['count'];
    }
    
}
