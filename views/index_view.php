<!DOCTYPE html>
<html lang="nl">
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
            <a href="#" class="nav-item">Home</a>
            <a href="#" class="nav-item">Products</a>
            <a href="#" class="nav-item">Contact</a>
        </div>
        <div class="search-container">
            <input type="text" class="search-input">
            <button class="search-button"><i class="fas fa-search"></i></button>
        </div>
    </nav>
</header>

<section class="hero">
    <div class="hero-content">
        <h1>Football <br>merchandise</h1>
        <p>Ontdek nu onze nieuwste voetbalcollectie!<br>
            Shop officiële shirts, accessoires en meer.<br>
            Wees sneller dan je tegenstanders en<br>
            scoor je favorieten!</p>
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
                    </div>
                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                    <p class="price">€ <?php echo number_format($product['price'], 2, ',', '.'); ?></p>
                    <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                <p>Er zijn momenteel geen producten beschikbaar.</p>
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
            <h4>Meld je aan</h4>
        </div>
    </div>
</footer>
<script src="js/main.js"></script>
</body>
</html>