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
<?php include 'header.php'; ?>

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
                <?php
                $maxDescriptionLength = 100; // Set the maximum length for the description
                if (strlen($product['description']) > $maxDescriptionLength) {
                    $truncatedDescription = substr($product['description'], 0, $maxDescriptionLength) . '...';
                } else {
                    $truncatedDescription = $product['description'];
                }
                ?>
                <div class="product-card">
                    <div class="product-image">
                        <a href="product.php?id=<?php echo htmlspecialchars($product['productID']); ?>">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>"
                                 alt="<?php echo htmlspecialchars($product['title']); ?>">
                        </a>
                    </div>
                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                    <p class="product-name"><?php echo htmlspecialchars($product['product_name']); ?></p>
                    <p class="price">€ <?php echo number_format($product['price'], 2, '.', ','); ?></p>
                    <!-- <p class="description"><?php echo htmlspecialchars($truncatedDescription); ?></p> -->
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                <p>There are currently no products available.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
<script src="js/main.js"></script>
</body>
</html>