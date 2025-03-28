<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Football Merchandise</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="products-container">
    <!-- Filter Sidebar -->
    <aside class="filter-sidebar">
        <h2>Filters</h2>
        
        <!-- Price Filter -->
        <div class="filter-section">
            <h3>Price Range</h3>
            <div class="price-slider">
                <div class="slider-container">
                    <div class="slider-track"></div>
                    <input type="range" id="price-range-min" class="price-range" min="0" max="200" value="0" step="1">
                    <input type="range" id="price-range-max" class="price-range" min="0" max="200" value="200" step="1">
                </div>
            </div>
            <div class="price-inputs">
                <div class="price-field">
                    <label for="min-price">From</label>
                    <div class="input-with-symbol">
                    € <input type="text" id="min-price" name="min-price" placeholder="Min">
                    </div>
                </div>
                <div class="price-field">
                    <label for="max-price">To</label>
                    <div class="input-with-symbol">
                        € <input type="text" id="max-price" name="max-price" placeholder="Max">
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Type Filter -->
        <div class="filter-section">
            <h3>Product Type</h3>
            <div class="product-type-filters">
                <?php
                $product_types = getUniqueProductTypes($pdo);
                foreach ($product_types as $type):
                    if (!empty($type)):
                ?>
                    <div class="filter-checkbox">
                        <input type="checkbox" id="type-<?php echo htmlspecialchars($type); ?>" 
                               name="product-type" value="<?php echo htmlspecialchars($type); ?>">
                        <label for="type-<?php echo htmlspecialchars($type); ?>"><?php echo htmlspecialchars($type); ?></label>
                    </div>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        </div>

        <button id="apply-filters" class="apply-filters-btn">Apply Filters</button>
        <button id="reset-filters" class="reset-filters-btn">Reset Filters</button>
    </aside>

    <!-- Products Section -->
    <section class="products">
        <h1 class="products-h1">Our Products</h1>
        <div class="product-grid">
            <?php if ($products && count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card" 
                         data-price="<?php echo htmlspecialchars(str_replace(',', '', $product['price'])); ?>"
                         data-type="<?php echo htmlspecialchars($product['title']); ?>">
                        <div class="product-image">
                            <a href="product.php?id=<?php echo htmlspecialchars($product['productID']); ?>">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['title']); ?>">
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
</div>

<?php include 'footer.php'; ?>
<script src="js/products.js"></script>
</body>
</html>
