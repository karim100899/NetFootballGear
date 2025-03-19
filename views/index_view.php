<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Merchandise</title>
    <link rel="stylesheet" href="css/styles.css">
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
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <div class="cart-item">
                                        <div class="cart-item-image">
                                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                        </div>
                                        <div class="cart-item-details">
                                            <p class="cart-item-title"><?php echo htmlspecialchars($item['title']); ?></p>
                                            <p class="cart-item-price">€ <?php echo number_format($item['price'], 2, '.', ','); ?></p>
                                        </div>
                                        <div class="cart-item-quantity">
                                            <span>Qty: <?php echo $item['quantity']; ?></span>
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

<section class="hero">
    <div class="hero-content">
        <h1>Football <br>merchandise</h1>
        <p>Discover our latest football collection now!<br>
            Shop official shirts, accessories and more.<br>
            Be faster than your opponents and<br>
            score your favorites!</p>
        <a href="#" class="shop-button">Shop now</a>
    </div>
    <div class="hero-image">
        <img src="images/hero-img.png" alt="Football jerseys and ball" class="hero-img">
    </div>
</section>

<section class="products">
    <div class="product-grid">
        <?php if ($products && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <a href="product.php?id=<?php echo htmlspecialchars($product['productID']); ?>">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>"
                                 alt="<?php echo htmlspecialchars($product['title']); ?>">
                        </a>
                    </div>
                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                    <p class="price">€ <?php echo number_format($product['price'], 2, '.', ','); ?></p>
                    <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                <p>There are currently no products available.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

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
                <li><a href="business-inquiry.php" class="business-link">Business Inquiries</a></li>
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
<script src="js/main.js"></script>
</body>
</html>