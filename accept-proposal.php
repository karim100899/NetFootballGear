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
        $insertProduct = $pdo->prepare("
            INSERT INTO products (
                title, 
                price, 
                image, 
                description, 
                product_name,
                companyID,
                status
            ) VALUES (
                :title, 
                :price, 
                :image, 
                :description, 
                :product_name,
                :company_id,
                'active'
            )
        ");
        
        $insertProduct->bindParam(':title', $proposal['product_type']);
        $insertProduct->bindParam(':price', $proposal['price']);
        $insertProduct->bindParam(':image', $proposal['image']);
        $insertProduct->bindParam(':description', $proposal['message']);
        $insertProduct->bindParam(':product_name', $proposal['product_name']);
        $insertProduct->bindParam(':company_id', $proposal['companyID']);
        $insertProduct->execute();

        // Update the status of the proposal to 'approved'
        $updateStatus = $pdo->prepare("UPDATE product_proposals SET status = 'approved' WHERE id = :id");
        $updateStatus->bindParam(':id', $proposalId);
        $updateStatus->execute();

        // Send notification email to the company
        $getCompanyEmail = $pdo->prepare("SELECT email FROM company WHERE companyID = :companyId");
        $getCompanyEmail->bindParam(':companyId', $proposal['companyID']);
        $getCompanyEmail->execute();
        $companyEmail = $getCompanyEmail->fetchColumn();

        if ($companyEmail) {
            $to = $companyEmail;
            $subject = 'Product Proposal Approved';
            $message = "
                <h1>Congratulations!</h1>
                <p>Your product proposal has been approved and is now listed on our website.</p>
                <p>Product Details:</p>
                <ul>
                    <li>Name: {$proposal['product_name']}</li>
                    <li>Type: {$proposal['product_type']}</li>
                    <li>Price: €{$proposal['price']}</li>
                </ul>
                <p>You can view and manage your products in your <a href='https://100899.stu.sd-lab.nl/beroeps2/NetFootballGear/website/seller-dashboard.php'>seller dashboard</a>.</p>
            ";
            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: NetFootballGear <noreply@netfootballgear.com>" . "\r\n";
            
            mail($to, $subject, $message, $headers);
        }

        header('Location: admin-dashboard.php?success=Product approved');
        exit;
    } else {
        header('Location: admin-dashboard.php?error=Proposal not found');
        exit;
    }
} else {
    header('Location: admin-dashboard.php?error=No proposal ID provided');
    exit;
}
?>  