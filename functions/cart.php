<?php
function addToCart($productId, $title, $price, $image, $quantity = 1) {
    // Initialiseer winkelwagen als die nog niet bestaat
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check of het product al in de winkelwagen zit
    $productExists = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['productId'] == $productId) {
            // Update hoeveelheid
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $productExists = true;
            break;
        }
    }
    
    // Voeg nieuw product toe als het nog niet in de winkelwagen zit
    if (!$productExists) {
        $_SESSION['cart'][] = [
            'productId' => $productId,
            'title' => $title,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }
}

function removeFromCart($productId) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['productId'] == $productId) {
                unset($_SESSION['cart'][$key]);
                // Herindexeer array
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
    }
}

function updateCartItemQuantity($productId, $quantity) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['productId'] == $productId) {
                $_SESSION['cart'][$key]['quantity'] = max(1, $quantity); // Minimaal 1
                break;
            }
        }
    }
}

function getCartContents() {
    return $_SESSION['cart'] ?? [];
}

function calculateCartTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

function clearCart() {
    $_SESSION['cart'] = [];
} 