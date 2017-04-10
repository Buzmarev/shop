<?php

class CategoryController {
    
    private static $limit = 6;

    public function actionIndex($page = 1) 
    {
        $category_id = -1;
        
        $category = Category::getCategoryList();
        $product_list = Product::getProductList(self::$limit, $page);
        
        $total = Product::getTotalProductAll();
        
        $pagination = new Pagination($total, $page, self::$limit, 'page-');
   
        require_once(ROOT. '/views/category/index.php');
        
        return true;
    }
    
    public function actionView($category_id, $page = 1)
    {
        $category = Category::getCategoryList();
        $product_list = Product::getProductListbyCategory($category_id, self::$limit, $page);
        
        $total = Product::getTotalProduct($category_id);
        
        $pagination = new Pagination($total, $page, self::$limit, 'page-');
   
        require_once(ROOT. '/views/category/index.php');
        
        return true;
    }
    
}
