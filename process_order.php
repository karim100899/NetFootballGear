<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'config.php';
require_once 'functions/auth.php';
require_once 'functions/cart.php';

// Check if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST); // Controleer of de gegevens worden verzonden
    try {
        // Start transaction
        $pdo->beginTransaction();

        // Get cart items and total
        $cartItems = getCartContents();
        var_dump($cartItems); // Dit toont de inhoud van de cart
        $cartTotal = calculateCartTotal();

        // Check if user is logged in
        if (isLoggedIn()) {
            $userId = $_POST['user_id'];
            $user = getUserById($pdo, $userId);
            
            // Insert order
            $stmt = $pdo->prepare("INSERT INTO orders_netFootballGear (userID, total_amount, order_date, status) VALUES (?, ?, NOW(), 'pending')");
            $stmt->execute([$userId, $cartTotal]);
            $orderId = $pdo->lastInsertId();

            // Insert shipping details
            $stmt = $pdo->prepare("INSERT INTO shipping_details_netFootballGear (order_id, street, house_number, postal_code, city, country) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $orderId,
                $_POST['street'],
                $_POST['house_number'],
                $_POST['postal_code'],
                $_POST['city'],
                $_POST['country']
            ]);
        } else {
            // Insert guest order
            $stmt = $pdo->prepare("INSERT INTO orders_netFootballGear (total_amount, order_date, status) VALUES (?, NOW(), 'pending')");
            $stmt->execute([$cartTotal]);
            $orderId = $pdo->lastInsertId();

            // Insert guest shipping details
            $stmt = $pdo->prepare("INSERT INTO shipping_details_netFootballGear (order_id, name, email, phone, street, house_number, postal_code, city, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $orderId,
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['street'],
                $_POST['house_number'],
                $_POST['postal_code'],
                $_POST['city'],
                $_POST['country']
            ]);
        }

        // Insert order items
        $stmt = $pdo->prepare("INSERT INTO order_items_netFootballGear (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($cartItems as $item) {
            var_dump($item); // Controleer de inhoud van $item
            $stmt->execute([
                $orderId,
                $item['productId'], // Zorg ervoor dat deze waarde niet null is
                $item['quantity'],
                $item['price']
            ]);
        }

        // Send confirmation email
        $to = isLoggedIn() ? $user['email'] : $_POST['email'];
        $subject = "Order Confirmation - NetFootballGear";
        
        $emailContent = "
            <html>
            <head>
                <title>Order Confirmation</title>
            </head>
            <body>
                <h2>Thank you for your order!</h2>
                <p>Order ID: #" . $orderId . "</p>
                <p>Total Amount: € " . number_format($cartTotal, 2) . "</p>
                <h3>Order Details:</h3>
                <ul>
        ";

        foreach ($cartItems as $item) {
            $emailContent .= "<li>" . htmlspecialchars($item['title']) . " x " . $item['quantity'] . " - € " . number_format($item['price'] * $item['quantity'], 2) . "</li>";
        }

        $emailContent .= "
                </ul>
                <p>We will process your order shortly.</p>
            </body>
            </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <noreply@netfootballgear.com>" . "\r\n";

        mail($to, $subject, $emailContent, $headers);

        // Clear cart
        clearCart();

        // Commit transaction
        $pdo->commit();

        // Redirect to success page
        header('Location: order_success.php?id=' . $orderId);
        exit;

    } catch (Exception $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        $error = 'There was an error processing your order. Please try again.';
        error_log("Order processing error: " . $e->getMessage());
        // Log the full error for debugging
        error_log("Full error: " . print_r($e, true));
    }
}

// If there was an error, redirect back to checkout
if ($error) {
    $_SESSION['checkout_error'] = $error;
    header('Location: checkout.php');
    exit;
} 