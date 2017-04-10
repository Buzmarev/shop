<?php

return array(
    
    'basket/drop/([0-9]+)' => 'BasketController/actionDrop/$1',
    'basket/delete/([0-9]+)' => 'BasketController/actionDelete/$1',
    'basket/add/([0-9]+)' => 'BasketController/actionAdd/$1',
    'basket/checkout' => 'BasketController/actionCheckout',
    'basket' => 'BasketController/actionIndex',
    
    'cabinet/edit' => 'CabinetController/actionEdit',
    'cabinet' => 'CabinetController/actionIndex',
    
    'user/logout' => 'UserController/actionLogout',
    'user/login' => 'UserController/actionLogin',
    'user/register' => 'UserController/actionRegister',
    
    'product/([0-9]+)' => 'ProductController/actionView/$1',
    
    'admin/product/create' => 'AdminController/actionProductCreate',
    'admin/product/update/([0-9]+)' => 'AdminController/actionProductUpdate/$1',
    'admin/product/delete/([0-9]+)' => 'AdminController/actionProductDelete/$1',
    'admin/product' => 'AdminController/actionProductIndex',
    
    'admin/category/create' => 'AdminController/actionCategoryCreate',
    'admin/category/update/([0-9]+)' => 'AdminController/actionCategoryUpdate/$1',
    'admin/category/delete/([0-9]+)' => 'AdminController/actionCategoryDelete/$1',
    'admin/category' => 'AdminController/actionCategoryIndex',
    
    'admin/order/view/([0-9]+)' => 'AdminController/actionOrderView/$1',
    'admin/order/update/([0-9]+)' => 'AdminController/actionOrderUpdate/$1',
    'admin/order/delete/([0-9]+)' => 'AdminController/actionOrderDelete/$1',
    'admin/order' => 'AdminController/actionOrderIndex',
    
    'admin' => 'AdminController/actionIndex',
    
    'category/([0-9]+)/page-([0-9]+)' => 'CategoryController/actionView/$1/$2',
    'category/([0-9]+)' => 'CategoryController/actionView/$1',
    'category/page-([0-9]+)' => 'CategoryController/actionIndex/$1',
    'category' => 'CategoryController/actionIndex',
    
    'about' => 'SiteController/actionAbout',
    
    'index.php' => 'SiteController/actionIndex',
    '' => 'SiteController/actionIndex',
    
);
