<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'config.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

// Check if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Get cart items and total
$cartItems = getCartContents();
$cartTotal = calculateCartTotal();

// Include the checkout view
include 'views/checkout_view.php'; 