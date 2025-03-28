<?php
session_start();
require_once 'config.php';
require_once 'functions/product.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

// Controleer of er een product ID is meegegeven
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($productId <= 0) {
    header('Location: index.php');
    exit;
}

// Haal product details op
$product = getProductById($pdo, $productId);

if (!$product) {
    header('Location: index.php');
    exit;
}

include 'views/product_view.php'; 