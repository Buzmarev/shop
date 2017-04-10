<?php

class SiteController {
    
    public function actionIndex() 
    { 
        $category_id = -1;
        
        $category = Category::getCategoryList();
        $product_list = Product::getProductList(9, 1);
        $slider = Product::getProductRecommended();
        
        require_once(ROOT. '/views/site/index.php');
        
        return true;
    }
    
    public function actionAbout()
    {
        require_once(ROOT. '/views/site/about.php');
        
        return true;
    }
    
}
