<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Football Merchandise</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<main class="cart-page">
    <div class="container">
        <h1>Shopping Cart</h1>
        
        <?php if (count($cartItems) > 0): ?>
            <div class="cart-section">
                <div class="cart-table">
                    <div class="cart-header">
                        <div class="cart-row">
                            <div class="cart-cell header">Product</div>
                            <div class="cart-cell header">Price</div>
                            <div class="cart-cell header">Quantity</div>
                            <div class="cart-cell header">Total</div>
                            <div class="cart-cell header"></div>
                        </div>
                    </div>
                    <div class="cart-body">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="cart-row">
                                <div class="cart-cell product-info">
                                    <div class="product-image">
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                    </div>
                                    <div class="product-details">
                                        <h3 class="product-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                                        <a href="product.php?id=<?php echo $item['productId']; ?>" class="view-product">View product</a>
                                    </div>
                                </div>
                                <div class="cart-cell price">
                                    € <?php echo number_format($item['price'], 2, '.', ','); ?>
                                </div>
                                <div class="cart-cell quantity">
                                    <form action="cart.php" method="POST" class="quantity-form">
                                        <input type="hidden" name="product_id" value="<?php echo $item['productId']; ?>">
                                        <input type="hidden" name="action" value="update">
                                        <div class="quantity-controls">
                                            <button type="button" class="quantity-btn minus" onclick="decrementQuantity(this.parentNode)">-</button>
                                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="99" class="quantity-input" onchange="this.form.submit()">
                                            <button type="button" class="quantity-btn plus" onclick="incrementQuantity(this.parentNode)">+</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="cart-cell total">
                                    € <?php echo number_format($item['price'] * $item['quantity'], 2, '.', ','); ?>
                                </div>
                                <div class="cart-cell remove">
                                    <form action="cart.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $item['productId']; ?>">
                                        <input type="hidden" name="action" value="remove">
                                        <button type="submit" class="remove-btn" title="Remove item">Remove</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="cart-summary">
                    <div class="summary-header">
                        <h2>Order Summary</h2>
                    </div>
                    <div class="summary-body">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>€ <?php echo number_format($cartTotal, 2, '.', ','); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>€ <?php echo number_format($cartTotal, 2, '.', ','); ?></span>
                        </div>
                        <div class="checkout-button-container">
                            <a href="checkout.php" class="checkout-button">Proceed to Checkout</a>
                        </div>
                        <div class="continue-shopping">
                            <a href="index.php">Continue Shopping</a>
                        </div>
                    </div>
                </div>
                
                <div class="cart-actions-full">
                    <form action="cart.php" method="POST" class="clear-cart-form">
                        <input type="hidden" name="action" value="clear">
                        <button type="submit" class="clear-cart-btn">Clear Cart</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <div class="empty-cart-message">
                    <i class="fas fa-shopping-cart icon"></i>
                    <h2>Your cart is empty</h2>
                    <p>Looks like you haven't added any products to your cart yet.</p>
                    <a href="index.php" class="continue-shopping-btn">Continue Shopping</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>

<script>
function incrementQuantity(container) {
    const input = container.querySelector('.quantity-input');
    const currentValue = parseInt(input.value);
    if (currentValue < 99) {
        input.value = currentValue + 1;
        container.closest('form').submit();
    }
}

function decrementQuantity(container) {
    const input = container.querySelector('.quantity-input');
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
        container.closest('form').submit();
    }
}
</script>
</body>
</html> 