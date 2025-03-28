<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    
    // Check if email exists in database
    $stmt = $pdo->prepare("SELECT userID, username FROM users_netFootballGear WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user) {
        // Generate unique token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+24 hours'));
        
        // Store token in database
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$email, $token, $expires]);
        
        // Send reset email
        $resetLink = "https://100899.stu.sd-lab.nl/beroeps2/NetFootballGear/website/reset-password.php?token=" . $token;
        
        $to = $email;
        $subject = "Password Reset Request";
        $message = "
            <html>
            <head>
                <title>Reset Your Password</title>
            </head>
            <body>
                <h2>Password Reset Request</h2>
                <p>You have requested to reset your password. Click the link below to set a new password:</p>
                <p><a href='{$resetLink}'>Reset Password</a></p>
                <p>This link will expire in 24 hours.</p>
                <p>If you did not request this password reset, please ignore this email.</p>
            </body>
            </html>
        ";
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: NetFootballGear <noreply@netfootballgear.com>" . "\r\n";
        
        if (mail($to, $subject, $message, $headers)) {
            $success = "If an account exists with this email, you will receive password reset instructions.";
        } else {
            $error = "There was a problem sending the email. Please try again later.";
        }
    } else {
        // Don't reveal if email exists or not
        $success = "If an account exists with this email, you will receive password reset instructions.";
    }
}

include 'views/forgot_password_view.php'; 