<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $phonenumber = $_POST['phonenumber'] ?? null;
    
    if (registerUser($pdo, $username, $email, $password, $phonenumber)) {
        header('Location: login.php?registered=1');
        exit;
    } else {
        $error = 'Registration failed';
    }
}

include 'views/register_view.php'; 