<?php
session_start();
require_once 'config.php';
require_once 'functions/product.php';
require_once 'functions/auth.php';

// Haal de zoekterm op uit de GET-parameters
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

// Als er geen zoekterm is, redirect naar de homepage
if (empty($searchQuery)) {
    header('Location: index.php');
    exit;
}

// Zoek producten op basis van de zoekterm
$products = searchProducts($pdo, $searchQuery);

// Inclusief de view voor zoekresultaten
include 'views/search_view.php'; 