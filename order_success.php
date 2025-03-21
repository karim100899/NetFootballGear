<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'config.php';
require_once 'functions/auth.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$orderId = (int)$_GET['id'];

// Get order details
$stmt = $pdo->prepare("SELECT * FROM orders_netFootballGear WHERE orderID = ?");
$stmt->execute([$orderId]);
$orderDetails = $stmt->fetch();

if (!$orderDetails) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .success-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            text-align: center;
        }

        .success-icon {
            color: #7abb7e;
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .order-details {
            background-color: #f5f5f5;
            padding: 30px;
            border-radius: 8px;
            text-align: left;
            margin-bottom: 30px;
        }

        .order-details h2 {
            color: #1e2130;
            margin-bottom: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
        }

        .detail-value {
            font-weight: bold;
            color: #1e2130;
        }

        .continue-shopping {
            display: inline-block;
            background-color: #7abb7e;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .continue-shopping:hover {
            background-color: #619864;
        }
    </style>
</head>
<body>
    <?php include 'views/header.php'; ?>

    <div class="success-container">
        <i class="fas fa-check-circle success-icon"></i>
        
        <div class="success-message">
            <h1>Thank you for your order!</h1>
            <p>Your order has been successfully placed and we'll process it shortly.</p>
        </div>

        <div class="order-details">
            <h2>Order Details</h2>
            <div class="detail-row">
                <span class="detail-label">Order ID:</span>
                <span class="detail-value">#<?php echo $orderId; ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Order Date:</span>
                <span class="detail-value"><?php echo date('F j, Y', strtotime($orderDetails['order_date'])); ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Amount:</span>
                <span class="detail-value">€ <?php echo number_format($orderDetails['total_amount'], 2); ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span class="detail-value"><?php echo ucfirst($orderDetails['status']); ?></span>
            </div>
        </div>

        <a href="products_list.php" class="continue-shopping">Continue Shopping</a>
    </div>

    <?php include 'views/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html> 