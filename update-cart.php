<?php
session_start();
require_once 'config.php';
require_once 'functions/cart.php';

// Get parameters from request
$action = $_POST['action'] ?? '';
$productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Return URL - default to index if not available
$returnUrl = $_SERVER['HTTP_REFERER'] ?? 'index.php';

// Process the requested action
if ($productId > 0) {
    switch ($action) {
        case 'update':
            updateCartItemQuantity($productId, $quantity);
            break;
            
        case 'remove':
            removeFromCart($productId);
            break;
    }
}

// Redirect back
header('Location: ' . $returnUrl);
exit; 