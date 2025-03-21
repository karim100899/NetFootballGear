<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'config.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get parameters from request
    $companyName = trim($_POST['company_name'] ?? '');
    $contactName = trim($_POST['contact_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $productName = trim($_POST['product_name'] ?? '');
    $productType = trim($_POST['product_type'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $price = trim($_POST['price'] ?? '');

    // Handle file upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded file to the desired directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $error = 'Failed to upload image.';
        }
    } else {
        // Check if the image key exists and handle the error
        if (!isset($_FILES['image'])) {
            $error = 'No image file was uploaded.';
        } else {
            $error = 'File upload error: ' . $_FILES['image']['error'];
        }
    }

    // Start a transaction
    $pdo->beginTransaction();

    try {
        // Check if the company already exists
        $checkCompany = $pdo->prepare("SELECT companyID FROM company WHERE email = :email LIMIT 1");
        $checkCompany->bindParam(':email', $email);
        $checkCompany->execute();
        $existingCompany = $checkCompany->fetch(PDO::FETCH_ASSOC);

        if ($existingCompany) {
            // Use existing company
            $companyID = $existingCompany['companyID'];
        } else {
            // Insert new company
            $insertCompany = $pdo->prepare("INSERT INTO company (companyName, contactName, email, phonenumber) VALUES (:company_name, :contact_name, :email, :phone)");
            $insertCompany->bindParam(':company_name', $companyName);
            $insertCompany->bindParam(':contact_name', $contactName);
            $insertCompany->bindParam(':email', $email);
            $insertCompany->bindParam(':phone', $phone);
            $insertCompany->execute();

            // Get the last inserted companyID
            $companyID = $pdo->lastInsertId();
        }

        // Now you can safely insert into product_proposals
        $insertProposal = $pdo->prepare("INSERT INTO product_proposals 
            (companyID, product_type, message, image, price, product_name, submission_date, status) 
            VALUES (:company_id, :product_type, :message, :image, :price, :product_name, NOW(), 'pending')");

        $insertProposal->bindParam(':company_id', $companyID);
        $insertProposal->bindParam(':product_type', $productType);
        $insertProposal->bindParam(':message', $message);
        $insertProposal->bindParam(':image', $imagePath);
        $insertProposal->bindParam(':price', $price);
        $insertProposal->bindParam(':product_name', $productName);
        $insertProposal->execute();

        // Send email notification
        $to = '100899@glr.nl'; // Replace with your email
        $subject = 'New Product Proposal';
        $body = "
            <h1>New Product Proposal</h1>
            <p>Company: {$companyName}</p>
            <p>Contact: {$contactName}</p>
            <p>Email: {$email}</p>
            <p>Phone: {$phone}</p>
            <p>Product Type: {$productType}</p>
            <p>Message: {$message}</p>
            <p>Image: <img src='{$imagePath}' alt='Product Image' /></p>
            <a href='https://100899.stu.sd-lab.nl/beroeps2/NetFootballGear/website/accept-proposal.php?id={$pdo->lastInsertId()}'>Accept Proposal</a>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <$email>" . "\r\n";

        mail($to, $subject, $body, $headers);

        // Commit the transaction
        $pdo->commit();
        $success = true;

    } catch (PDOException $e) {
        // Rollback on error
        $pdo->rollBack();
        error_log("Business inquiry submission error: " . $e->getMessage());
        $error = 'There was a problem with our system. Please try again later.';
        // Optionally, you can also log the full exception for debugging
        error_log($e);
    }
}

include 'views/business_inquiry_view.php'; 