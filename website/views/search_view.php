<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results: <?php echo htmlspecialchars($searchQuery); ?> - Football Merchandise</title>
    <link rel="icon" href="images/NetFootballGear-flaticon.png" type="image/png">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<section class="search-results">
    <div class="search-header">
        <h1>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h1>
        <p>We found <?php echo count($products); ?> product(s) matching your search.</p>
    </div>

    <div class="product-grid">
        <?php if ($products && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <a href="product.php?id=<?php echo htmlspecialchars($product['productID']); ?>">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
                        </a>
                    </div>
                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                    <p class="product-name"><?php echo isset($product['product_name']) ? htmlspecialchars($product['product_name']) : 'N/A'; ?></p>
                    <p class="price">€ <?php echo number_format($product['price'], 2, '.', ','); ?></p>
<!--                    <p class="description">--><?php //echo htmlspecialchars($product['description']); ?><!--</p>-->
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

<?php include 'footer.php'; ?>
<script src="js/main.js"></script>
</body>
</html> 