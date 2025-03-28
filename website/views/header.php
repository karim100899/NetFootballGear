<header>
    <nav>
        <div class="nav-links">
            <a href="index.php" class="nav-item">Home</a>
            <a href="products_list.php" class="nav-item">Products</a>
            <a href="contact.php" class="nav-item">Contact</a>
        </div>
        
        <div class="right-section">
            <div class="search-container">
                <form action="search.php" method="GET">
                    <input type="text" name="q" class="search-input" placeholder="Search products...">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </form>
            </div>
            
            <div class="cart-menu">
                <a href="cart.php" class="cart-button">
                    <img src="images/shopping-cart.png" alt="Shopping cart" class="cart-icon">
                    <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                </a>
            </div>
            
            <div class="user-menu">
                <?php if (isLoggedIn()): ?>
                    <div class="user-dropdown">
                        <button class="user-button">
                            <img src="images/user.png" alt="User menu" class="user-icon">
                        </button>
                        <div class="dropdown-content">
                            <p class="dropdown-username"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'seller'): ?>
                                <a href="seller-dashboard.php" class="dropdown-item">
                                    <i class="fas fa-chart-line"></i> Seller Dashboard
                                </a>
                            <?php endif; ?>
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

<style>
/* Bestaande stijlen behouden */

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 8px 16px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.2s;
}

.dropdown-item:hover {
    background-color: #f5f5f5;
}

.dropdown-item i {
    color: #7abb7e;
    font-size: 1.1em;
}
</style>