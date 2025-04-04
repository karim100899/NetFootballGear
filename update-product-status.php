<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'config.php';

// Check if the product ID and status are set
if (isset($_POST['product_id']) && isset($_POST['status'])) {
    $productId = (int)$_POST['product_id'];
    $newStatus = $_POST['status'];

    // Update the product status in the database
    $stmt = $pdo->prepare("UPDATE products_netFootballGear SET status = :status WHERE productID = :productId");
    $stmt->bindParam(':status', $newStatus);
    $stmt->bindParam(':productId', $productId);
    
    if ($stmt->execute()) {
        // Redirect back to the seller dashboard with a success message
        header('Location: seller-dashboard.php?status=success');
        exit; // Ensure no further code is executed
    } else {
        // Handle error
        header('Location: seller-dashboard.php?status=error');
        exit; // Ensure no further code is executed
    }
} else {
    // Redirect back if parameters are missing
    header('Location: seller-dashboard.php?status=error');
    exit; // Ensure no further code is executed
}
