<?php
session_start();
require_once 'config.php';
require_once 'functions/product.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

// Controleer of er een actie is opgegeven
$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    
    switch ($action) {
        case 'update':
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            updateCartItemQuantity($productId, $quantity);
            break;
            
        case 'remove':
            removeFromCart($productId);
            break;
            
        case 'clear':
            clearCart();
            break;
    }
    
    // Redirect to prevent form resubmission
    header('Location: cart.php');
    exit;
}

// Haal winkelwagen items op
$cartItems = getCartContents();
$cartTotal = calculateCartTotal();

include 'views/cart_view.php'; 