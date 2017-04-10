<?php

class ProductController {
    
    public function actionView($id)
    {
        $category = Category::getCategoryList();
        $product = Product::getProductSingle($id);
        
        $category_id = $product['category_id'];
        
        require_once ROOT. '/views/product/view.php';
        
        return true;
    }
    
}
