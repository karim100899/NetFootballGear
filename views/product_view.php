<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['title']); ?> - Football Merchandise</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/product-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="nav-links">
                <a href="index.php" class="nav-item">Home</a>
                <a href="#" class="nav-item">Products</a>
                <a href="#" class="nav-item">Contact</a>
            </div>
            
            <div class="right-section">
                <div class="search-container">
                    <form action="search.php" method="GET">
                        <input type="text" name="q" class="search-input" placeholder="Search products...">
                        <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                
                <div class="cart-menu">
                    <div class="cart-dropdown">
                        <button class="cart-button">
                            <img src="images/shopping-cart.png" alt="Shopping cart" class="cart-icon">
                            <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                        </button>
                        <div class="cart-dropdown-content">
                            <h4>Your Cart</h4>
                            <div class="cart-items">
                                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                                    <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                                        <div class="cart-item">
                                            <div class="cart-item-image">
                                                <img src="<?php echo htmlspecialchars($cartItem['image']); ?>" alt="<?php echo htmlspecialchars($cartItem['title']); ?>">
                                            </div>
                                            <div class="cart-item-details">
                                                <p class="cart-item-title"><?php echo htmlspecialchars($cartItem['title']); ?></p>
                                                <p class="cart-item-price">€ <?php echo number_format($cartItem['price'], 2, '.', ','); ?></p>
                                            </div>
                                            <div class="cart-item-controls">
                                                <form action="update-cart.php" method="POST" class="cart-quantity-form">
                                                    <input type="hidden" name="product_id" value="<?php echo $cartItem['productId']; ?>">
                                                    <input type="hidden" name="action" value="update">
                                                    <select name="quantity" class="cart-quantity-select" onchange="this.form.submit()">
                                                        <?php for($i = 1; $i <= 10; $i++): ?>
                                                            <option value="<?php echo $i; ?>" <?php echo ($i == $cartItem['quantity']) ? 'selected' : ''; ?>>
                                                                <?php echo $i; ?>
                                                            </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </form>
                                                <form action="update-cart.php" method="POST" class="cart-remove-form">
                                                    <input type="hidden" name="product_id" value="<?php echo $cartItem['productId']; ?>">
                                                    <input type="hidden" name="action" value="remove">
                                                    <button type="submit" class="cart-remove-btn" title="Remove from cart">×</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="cart-subtotal">
                                        <p>Subtotal: <span>€ <?php echo number_format(calculateCartTotal(), 2, '.', ','); ?></span></p>
                                    </div>
                                    <div class="cart-actions">
                                        <a href="cart.php" class="view-cart-btn">View Cart</a>
                                        <a href="checkout.php" class="checkout-btn">Checkout</a>
                                    </div>
                                <?php else: ?>
                                    <p class="empty-cart-message">Your cart is empty</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="user-menu">
                    <?php if (isLoggedIn()): ?>
                        <div class="user-dropdown">
                            <button class="user-button">
                                <img src="images/user.png" alt="User menu" class="user-icon">
                            </button>
                            <div class="dropdown-content">
                                <p class="dropdown-username"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                                <a href="switch_account.php">Switch Account</a>
                                <a href="logout.php">Log Out</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="auth-buttons">
                            <a href="login.php" class="auth-link">Log In</a>
                            <a href="register.php" class="auth-link">Register</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <main class="product-detail">
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                     alt="<?php echo htmlspecialchars($product['title']); ?>">
            </div>
            <div class="product-info">
                <h1><?php echo htmlspecialchars($product['title']); ?></h1>
                <p class="price">€ <?php echo number_format($product['price'], 2, '.', ','); ?></p>
                <div class="description">
                    <?php echo htmlspecialchars($product['description']); ?>
                </div>
                <form action="add-to-cart.php" method="POST" class="add-to-cart-form">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['productID']); ?>">
                    <div class="quantity-selector">
                        <label for="quantity">Quantity:</label>
                        <select name="quantity" id="quantity">
                            <?php for($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <button type="submit" class="add-to-cart">Add to Cart</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Service & Contact</h4>
            </div>
            <div class="footer-section">
                <h4>Subscribe</h4>
            </div>
        </div>
    </footer>
    <script src="js/main.js"></script>
</body>
</html>