<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

// Check if user is logged in and is a seller
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'seller') {
    header('Location: login.php?error=Please log in as a seller to access the dashboard');
    exit;
}

// Get company information using the company_id from session
$companyId = $_SESSION['company_id'];
$stmt = $pdo->prepare("SELECT * FROM company WHERE companyID = :companyId");
$stmt->execute([':companyId' => $companyId]);
$company = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$company) {
    header('Location: index.php?error=Company not found');
    exit;
}

// Get seller's products and orders
$products = getSellerProducts($pdo, $companyId);
$orders = getSellerOrders($pdo, $companyId);

// Calculate statistics
$totalSales = 0;
$totalRevenue = 0;
$totalProducts = count($products);
$activeProducts = 0;

foreach ($orders as $order) {
    $totalSales += $order['quantity'];
    $totalRevenue += ($order['quantity'] * $order['item_price']);
}

foreach ($products as $product) {
    if ($product['status'] !== 'inactive') {
        $activeProducts++;
    }
}

// Include the dashboard view
include 'views/seller_dashboard_view.php'; 