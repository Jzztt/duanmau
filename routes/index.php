<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    // Home
    '/'         => (new HomeController)->index(),
    
    // Category routes
    'category-index'    => (new CategoryController)->index(),
    'category-create'   => (new CategoryController)->create(),
    'category-store'    => (new CategoryController)->store(),
    'category-edit'     => (new CategoryController)->edit(),
    'category-update'   => (new CategoryController)->update(),
    'category-delete'   => (new CategoryController)->delete(),
    
    // Product routes
    'product-index'     => (new ProductController)->index(),
    'product-create'    => (new ProductController)->create(),
    'product-store'     => (new ProductController)->store(),
    'product-edit'      => (new ProductController)->edit(),
    'product-update'    => (new ProductController)->update(),
    'product-delete'    => (new ProductController)->delete(),
    
    // Default
    default             => (new HomeController)->index(),
};