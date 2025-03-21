<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'config.php';

if (isset($_GET['id'])) {
    $proposalId = (int)$_GET['id'];

    // Fetch proposal details
    $stmt = $pdo->prepare("SELECT * FROM product_proposals WHERE id = :id");
    $stmt->bindParam(':id', $proposalId);
    $stmt->execute();
    $proposal = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($proposal) {
        // Insert into products table
        $insertProduct = $pdo->prepare("INSERT INTO products (title, price, image, description, product_name) VALUES (:title, :price, :image, :description, :product_name)");
        $insertProduct->bindParam(':title', $proposal['product_type']);
        $insertProduct->bindParam(':price', $proposal['price']); // Ensure this field exists
        $insertProduct->bindParam(':image', $proposal['image']); // Ensure this field exists
        $insertProduct->bindParam(':description', $proposal['message']);
        $insertProduct->bindParam(':product_name', $proposal['product_name']); // Bind the product name
        $insertProduct->execute();

        // Update the status of the proposal to 'approved'
        $updateStatus = $pdo->prepare("UPDATE product_proposals SET status = 'approved' WHERE id = :id");
        $updateStatus->bindParam(':id', $proposalId);
        $updateStatus->execute();

        echo "Product accepted and added to the database.";
    } else {
        echo "Proposal not found.";
    }
} else {
    echo "No proposal ID provided.";
}
?>  