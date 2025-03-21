<?php
session_start();
require_once 'config.php';
require_once 'functions/product.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

// Fetch all products
$products = getAllProducts($pdo); // This function retrieves all products

include 'views/products_view.php'; // Include the view for displaying products
