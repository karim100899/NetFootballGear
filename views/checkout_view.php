<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="checkout-container">
        <div class="checkout-header">
            <h1>Checkout</h1>
            <p>Complete your order</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="checkout-content">
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                            <div class="item-details">
                                <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                                <p class="price">€ <?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="order-total">
                    <h3>Total: € <?php echo number_format($cartTotal, 2); ?></h3>
                </div>
            </div>

            <div class="checkout-form">
                <?php if (isLoggedIn()): ?>
                    <!-- Logged in user form -->
                    <h2>Shipping Information</h2>
                    <form action="process_order.php" method="POST" class="shipping-form">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        
                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street" required>
                        </div>

                        <div class="form-group">
                            <label for="house_number">House Number</label>
                            <input type="text" id="house_number" name="house_number" required>
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" required>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" required>
                        </div>

                        <button type="submit" class="place-order-btn">Place Order</button>
                    </form>
                <?php else: ?>
                    <!-- Guest checkout form -->
                    <h2>Guest Checkout</h2>
                    <form action="process_order.php" method="POST" class="guest-form">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street" required>
                        </div>

                        <div class="form-group">
                            <label for="house_number">House Number</label>
                            <input type="text" id="house_number" name="house_number" required>
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" required>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" required>
                        </div>

                        <button type="submit" class="place-order-btn">Place Order</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html> 