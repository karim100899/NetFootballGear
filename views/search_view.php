<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results: <?php echo htmlspecialchars($searchQuery); ?> - Football Merchandise</title>
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
                    <input type="text" name="q" class="search-input" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search products...">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </form>
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

<section class="search-results">
    <div class="search-header">
        <h1>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h1>
        <p>We found <?php echo count($products); ?> product(s) matching your search.</p>
    </div>

    <div class="product-grid">
        <?php if ($products && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <a href="product.php?id=<?php echo htmlspecialchars($product['productID']); ?>">
                        <div class="product-image">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>"
                                 alt="<?php echo htmlspecialchars($product['title']); ?>">
                        </div>
                        <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                        <p class="price">€ <?php echo number_format($product['price'], 2, '.', ','); ?></p>
                        <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                <p>No products found matching your search.</p>
                <p>Try different search terms or <a href="index.php">return to homepage</a>.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

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