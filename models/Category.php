<?php

class Category {
    
    public static function getCategoryList()
    {
        $db = DB::getConnection();
        
        $category_list = array();
        $result = $db -> query('SELECT id, name FROM category ORDER BY sort_order ASC');
        
        for($i = 0; $row = $result -> fetch(); $i++){
            $category_list[$i]['id'] = $row['id'];
            $category_list[$i]['name'] = $row['name'];
        }
        
        return $category_list;
    }
    
    public static function getCategorySingle($id)
    {
        $db = DB::getConnection();
         
        $result = $db -> query("SELECT * FROM category WHERE id = $id");
        $result ->setFetchMode(PDO::FETCH_ASSOC);
        
        $category = $result -> fetch();
        
        return $category;
    }
    
    public static function getCategoryListAdmin()
    {
        $db = DB::getConnection();
        
        $category_list = array();
        $result = $db -> query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');
        
        for($i = 0; $row = $result -> fetch(); $i++){
            $category_list[$i]['id'] = $row['id'];
            $category_list[$i]['name'] = $row['name'];
            $category_list[$i]['sort_order'] = $row['sort_order'];
            $category_list[$i]['status'] = $row['status'];
        }
        
        return $category_list;
    }
    
}
