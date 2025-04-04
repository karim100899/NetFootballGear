<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

// Check if product ID is set
if (!isset($_GET['id'])) {
    header('Location: seller-dashboard.php?status=error');
    exit;
}

$productId = (int)$_GET['id'];

// Fetch product details from the database
$stmt = $pdo->prepare("SELECT * FROM products_netFootballGear WHERE productID = :productId");
$stmt->bindParam(':productId', $productId);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: seller-dashboard.php?status=error');
    exit;
}

// Include the view
include 'views/edit-product-view.php';
