<?php
session_start();
require_once 'config.php';
require_once 'functions/product.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

// Haal random producten op
$products = getRandomProducts($pdo);

include 'views/index_view.php';