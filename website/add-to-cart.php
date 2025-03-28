<?php
session_start();
require_once 'config.php';
require_once 'functions/product.php';
require_once 'functions/cart.php';

// Controleer of er een product ID is meegegeven
$productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Valideer hoeveelheid
if ($quantity < 1) {
    $quantity = 1;
}

if ($productId > 0) {
    // Haal productdetails op
    $product = getProductById($pdo, $productId);
    
    if ($product) {
        // Voeg toe aan winkelwagen
        addToCart(
            $product['productID'],
            $product['title'],
            $product['price'],
            $product['image'],
            $quantity
        );
        
        // Redirect terug naar vorige pagina
        $redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header('Location: ' . $redirect);
        exit;
    }
}

// Als er iets fout ging, terug naar index
header('Location: index.php');
exit; 