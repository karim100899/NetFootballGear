<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

$error = '';
$success = '';
$validToken = false;
$token = $_GET['token'] ?? '';

// Validate token
$stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND used = 0 AND expires_at > NOW()");
$stmt->execute([$token]);
$reset = $stmt->fetch();

if (!$reset) {
    $error = "This password reset link has expired or is invalid. Please request a new one.";
    $validToken = false;
} else {
    $validToken = true;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        // Validate passwords
        if (strlen($password) < 8) {
            $error = "Password must be at least 8 characters long.";
        } elseif ($password !== $confirm_password) {
            $error = "Passwords do not match.";
        } else {
            try {
                $pdo->beginTransaction();
                
                // Update user password
                $stmt = $pdo->prepare("UPDATE users_netFootballGear SET password = ? WHERE email = ?");
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt->execute([$hashedPassword, $reset['email']]);
                
                // Mark token as used
                $stmt = $pdo->prepare("UPDATE password_resets SET used = 1 WHERE token = ?");
                $stmt->execute([$token]);
                
                $pdo->commit();
                
                // Send confirmation email
                $to = $reset['email'];
                $subject = "Password Successfully Reset";
                $message = "
                <html>
                <body>
                    <h2>Password Reset Successful</h2>
                    <p>Your password has been successfully reset.</p>
                    <p>If you did not make this change, please contact us immediately.</p>
                </body>
                </html>";
                
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: NetFootballGear <noreply@netfootballgear.com>";
                
                mail($to, $subject, $message, $headers);
                
                $success = "Your password has been reset successfully. You can now log in with your new password.";
                $validToken = false;
            } catch (Exception $e) {
                $pdo->rollBack();
                $error = "An error occurred. Please try again.";
                error_log($e->getMessage());
            }
        }
    }
}

include 'views/reset_password_view.php'; 