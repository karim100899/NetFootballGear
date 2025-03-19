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

<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h4>Customer Service</h4>
            <ul>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="shipping.php">Shipping & Delivery</a></li>
                <li><a href="returns.php">Returns & Exchanges</a></li>
                <li><a href="size-guide.php">Size Guide</a></li>
                <li><a href="faq.php">FAQ</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>About Us</h4>
            <ul>
                <li><a href="about.php">Our Story</a></li>
                <li><a href="stores.php">Stores</a></li>
                <li><a href="careers.php">Careers</a></li>
                <li><a href="sustainability.php">Sustainability</a></li>
                <li><a href="press.php">Press</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Legal Information</h4>
            <ul>
                <li><a href="terms.php">Terms & Conditions</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="cookies.php">Cookie Policy</a></li>
                <li><a href="sales-terms.php">Terms of Sale</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Subscribe</h4>
            <p>Stay updated with our latest offers and products</p>
            <form action="subscribe.php" method="POST" class="newsletter-form">
                <input type="email" name="email" placeholder="Your email address" class="newsletter-input" required>
                <button type="submit" class="newsletter-button">Subscribe</button>
            </form>
            <div class="social-icons">
                <a href="https://facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="https://youtube.com" target="_blank" class="social-icon"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> NetFootballGear. All rights reserved.</p>
        <div class="payment-methods">
            <i class="fab fa-cc-visa"></i>
            <i class="fab fa-cc-mastercard"></i>
            <i class="fab fa-cc-paypal"></i>
            <span class="ideal-icon">iDEAL</span>
        </div>
    </div>
</footer>

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