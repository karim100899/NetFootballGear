<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Football Merchandise</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<section class="products">
    <h1 class="products-h1">Our Products</h1>
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
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-products">
                <p>No products available at this time.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
