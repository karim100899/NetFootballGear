<header>
    <nav>
        <div class="nav-links">
            <a href="index.php" class="nav-item">Home</a>
            <a href="products_list.php" class="nav-item">Products</a>
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
                    <a href="cart.php" class="cart-button">
                        <img src="images/shopping-cart.png" alt="Shopping cart" class="cart-icon">
                        <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                    </a>
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
                                    </div>
                                <?php endforeach; ?>
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