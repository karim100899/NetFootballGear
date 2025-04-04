<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

// Check if product ID is set
if (isset($_POST['product_id'])) {
    $productId = (int)$_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle image upload if a new image is provided
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded file to the desired directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            header('Location: seller-dashboard.php?status=error');
            exit;
        }
    }

    // Prepare the SQL statement
    if ($imagePath) {
        // If a new image is uploaded, update the image path
        $stmt = $pdo->prepare("UPDATE products_netFootballGear SET product_name = :productName, price = :price, description = :description, image = :image WHERE productID = :productId");
        $stmt->bindParam(':image', $imagePath);
    } else {
        // If no new image is uploaded, do not update the image path
        $stmt = $pdo->prepare("UPDATE products_netFootballGear SET product_name = :productName, price = :price, description = :description WHERE productID = :productId");
    }

    // Bind parameters
    $stmt->bindParam(':productName', $productName);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':productId', $productId);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the seller dashboard with a success message
        header('Location: seller-dashboard.php?status=success');
        exit;
    } else {
        // Handle error
        header('Location: seller-dashboard.php?status=error');
        exit;
    }
} else {
    // Redirect back if parameters are missing
    header('Location: seller-dashboard.php?status=error');
    exit;
}
?>
