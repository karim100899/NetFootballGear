<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valideer en verwerk het formulier
    $companyName = trim($_POST['company_name'] ?? '');
    $contactName = trim($_POST['contact_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $productType = trim($_POST['product_type'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Eenvoudige validatie
    if (empty($companyName) || empty($contactName) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        try {
            // Start een transactie
            $pdo->beginTransaction();
            
            // Haal userID op als de gebruiker is ingelogd
            $userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            
            // Controleer of het bedrijf al bestaat
            $checkCompany = $pdo->prepare("SELECT companyID FROM company WHERE email = :email LIMIT 1");
            $checkCompany->bindParam(':email', $email);
            $checkCompany->execute();
            $existingCompany = $checkCompany->fetch(PDO::FETCH_ASSOC);
            
            if ($existingCompany) {
                // Gebruik bestaand bedrijf
                $companyID = $existingCompany['companyID'];
                
                // Update contactgegevens
                $updateCompany = $pdo->prepare("UPDATE company SET 
                    companyName = :company_name, 
                    contactName = :contact_name, 
                    phonenumber = :phone 
                    WHERE companyID = :company_id");
                    
                $updateCompany->bindParam(':company_name', $companyName);
                $updateCompany->bindParam(':contact_name', $contactName);
                $updateCompany->bindParam(':phone', $phone);
                $updateCompany->bindParam(':company_id', $companyID);
                $updateCompany->execute();
            } else {
                // Maak nieuw bedrijf aan
                $insertCompany = $pdo->prepare("INSERT INTO company 
                    (companyName, contactName, email, phonenumber, userID) 
                    VALUES (:company_name, :contact_name, :email, :phone, :user_id)");
                    
                $insertCompany->bindParam(':company_name', $companyName);
                $insertCompany->bindParam(':contact_name', $contactName);
                $insertCompany->bindParam(':email', $email);
                $insertCompany->bindParam(':phone', $phone);
                $insertCompany->bindParam(':user_id', $userID);
                $insertCompany->execute();
                
                $companyID = $pdo->lastInsertId();
            }
            
            // Voeg productvoorstel toe
            $insertProposal = $pdo->prepare("INSERT INTO product_proposals 
                (companyID, product_type, message, submission_date) 
                VALUES (:company_id, :product_type, :message, NOW())");
                
            $insertProposal->bindParam(':company_id', $companyID);
            $insertProposal->bindParam(':product_type', $productType);
            $insertProposal->bindParam(':message', $message);
            $insertProposal->execute();
            
            // Commit de transactie
            $pdo->commit();
            $success = true;
            
        } catch (PDOException $e) {
            // Rollback bij fouten
            $pdo->rollBack();
            error_log("Business inquiry submission error: " . $e->getMessage());
            $error = 'There was a problem with our system. Please try again later.';
        }
    }
}

include 'views/business_inquiry_view.php'; 