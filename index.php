<?php
require_once 'config.php';
require_once 'functions/product.php';

// Haal random producten op
$products = getRandomProducts($pdo);

include 'views/index_view.php';