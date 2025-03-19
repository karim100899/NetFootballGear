<?php
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

// Bewaar huidige gebruiker ID voor later
$currentUserId = $_SESSION['user_id'] ?? null;

// Verwijder huidige sessie maar behoud de pagina waar we waren
$returnTo = $_SERVER['HTTP_REFERER'] ?? 'index.php';
session_destroy();
session_start();

// Sla op waar we naartoe moeten na login
$_SESSION['return_to'] = $returnTo;
$_SESSION['switching_account'] = true;
$_SESSION['previous_user'] = $currentUserId;

// Redirect naar login pagina
header('Location: login.php');
exit; 