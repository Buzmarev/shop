<?php

class AdminController {
    
    public function actionIndex()
    {
        Admin::verificationAdmin();
        
        require_once(ROOT. '/views/admin/index.php');
        
        return true;
    }
    
    public function actionProductIndex()
    {
        Admin::verificationAdmin();
        
        $products = Admin::getProductList();
        
        require_once(ROOT. '/views/admin/product_index.php');
        
        return true;
    }
    
    public function actionProductCreate()
    {
        Admin::verificationAdmin();
        
        $categories = Category::getCategoryListAdmin();
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            
            $errors = false;
            if (!isset($options['name']) || empty($options['name']) ||
                !isset($options['code']) || empty($options['code']) ||
                !isset($options['price']) || empty($options['price']) ||
                !isset($options['brand']) || empty($options['brand']) ||
                !isset($options['description']) || empty($options['description'])
                    ){
                $errors[] = 'Заполните поля';
            }
            
            if ($errors == false) {
                $id = Admin::createProduct($options);
                
                if ($id) {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])){
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . 
                        "/template/images/product/{$id}.jpg");
                        Admin::updateProductImage($id);
                    }
                };
                
                header("Location: /admin/product");
            }
        }

        require_once(ROOT . '/views/admin/product_create.php');
        
        return true;
    }
    
    public function actionProductUpdate($id)
    {
        Admin::verificationAdmin();
        
        $categories = Category::getCategoryListAdmin();
        
        $product = Product::getProductSingle($id);
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            
           if (Admin::updateProduct($id, $options)) {
                if (is_uploaded_file($_FILES["image"]["tmp_name"])){
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . 
                        "/template/images/product/{$id}.jpg");
                        Admin::updateProductImage($id);
                }
            }
            
            header("Location: /admin/product");
        }

        require_once(ROOT . '/views/admin/product_update.php');
        
        return true;
    }
    
    public function actionProductDelete($id)
    {
        Admin::verificationAdmin();
        
        Admin::deleteProduct($id);
        
        header('Location /admin/product');
    }
    ///////////////////////////////////////////////////////////
    public function actionCategoryIndex()
    {
        Admin::verificationAdmin();
        
        $categories = Category::getCategoryListAdmin();
        
        require_once(ROOT. '/views/admin/category_index.php');
        
        return true;
    }
    
    public function actionCategoryCreate()
    {
        Admin::verificationAdmin();
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            
            $errors = false;
            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'Заполните поля';
            }
            
            if ($errors == false) {
                $id = Admin::createCategory($options);
                
                header("Location: /admin/category");
            }
        }

        require_once(ROOT . '/views/admin/category_create.php');
        
        return true;
    }
    
    public function actionCategoryUpdate($id)
    {
        Admin::verificationAdmin();
        
        $category = Category::getCategorySingle($id);
        
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];
            
            Admin::updateCategory($id, $options);
            
            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin/category_update.php');
        
        return true;
    }
    
    public function actionCategoryDelete($id)
    {
        Admin::verificationAdmin();
        
        Admin::deleteCategory($id);
        
        header('Location /admin/category');
    }
    ///////////////////////////////////////////////
    public function actionOrderIndex()
    {
        Admin::verificationAdmin();
        
        $orders = Admin::getOrderList();
        
        require_once(ROOT. '/views/admin/order_index.php');
        
        return true;
    }
    
    public function actionOrderView($id)
    {
        Admin::verificationAdmin();
        
        $order = Admin::getOrderSingle($id);
        
        $products = json_decode($order['products'], true);
        
        require_once(ROOT . '/views/admin/order_view.php');
        
        return true;
    }
    
    public function actionOrderUpdate($id)
    {
        Admin::verificationAdmin();
        
        $order = Admin::getOrderSingle($id);
        
        if (isset($_POST['submit'])) {
            $options['userName'] = $_POST['userName'];
            $options['userPhone'] = $_POST['userPhone'];
            $options['userComment'] = $_POST['userComment'];
            $options['date'] = $_POST['date'];
            $options['status'] = $_POST['status'];
            
            Admin::updateOrder($id, $options);
            
            header("Location: /admin/order/view/$id");
        }

        require_once(ROOT . '/views/admin/order_update.php');
        
        return true;
    }
    
    public function actionOrderDelete($id)
    {
        Admin::verificationAdmin();
        
        Admin::deleteOrder($id);
        
        header('Location /admin/order');
    }
    
}
