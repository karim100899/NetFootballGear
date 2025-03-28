<?php
session_start();
require_once 'config.php';
require_once 'functions/product.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

// Get product ID from URL
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get the product details
$product = getProductById($pdo, $productId);

// If no product found, redirect to products page
if (!$product) {
    header('Location: products.php');
    exit;
}

// Get related products (you can implement this based on your needs)
$relatedProducts = getFilteredProducts($pdo, [
    'product_type' => [$product['title']], // Get products of same type
    'exclude_id' => $productId // Exclude current product
]);

include 'views/product_view.php'; 