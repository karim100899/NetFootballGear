<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

$error = '';
$switching = isset($_SESSION['switching_account']) && $_SESSION['switching_account'];
$returnTo = $_SESSION['return_to'] ?? 'index.php';

// Als de gebruiker al ingelogd is
if (isLoggedIn() && !$switching) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($identifier) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        if (loginUser($pdo, $identifier, $password)) {
            // Verwijder switch-gerelateerde sessievariabelen
            unset($_SESSION['switching_account']);
            unset($_SESSION['return_to']);
            unset($_SESSION['previous_user']);
            
            // Redirect naar de juiste pagina
            header('Location: ' . $returnTo);
            exit;
        } else {
            $error = 'Invalid login credentials';
        }
    }
}

// Update de titel op basis van of we van account wisselen
$pageTitle = $switching ? 'Switch Account' : 'Log In';

include 'views/login_view.php'; 