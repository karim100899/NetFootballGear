<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/seller-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="seller-dashboard">
        <div class="container">
            <div class="dashboard-header">
                <h1>Welcome, <?php echo htmlspecialchars($company['companyName']); ?>!</h1>
                <p>Manage your products and view your sales performance</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Total Sales</h3>
                    <p><?php echo $totalSales; ?> items</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-euro-sign"></i>
                    <h3>Total Revenue</h3>
                    <p>€<?php echo number_format($totalRevenue, 2); ?></p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-box"></i>
                    <h3>Active Products</h3>
                    <p><?php echo $activeProducts; ?> / <?php echo $totalProducts; ?></p>
                </div>
            </div>

            <div class="dashboard-content">
                <section class="products-section">
                    <div class="section-header">
                        <h2>Your Products</h2>
                        <a href="business-inquiry.php" class="add-product-btn">
                            <i class="fas fa-plus"></i> Add New Product
                        </a>
                    </div>
                    
                    <div class="products-grid">
                        <?php if (empty($products)): ?>
                            <p class="no-items">No products yet. Add your first product!</p>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <div class="product-card">
                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                    <div class="product-info">
                                        <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                                        <p class="price">€<?php echo number_format($product['price'], 2); ?></p>
                                        <p class="sales">Sales: <?php echo $product['total_sales'] ?? 0; ?></p>
                                        <div class="product-actions">
                                            <a href="edit-product.php?id=<?php echo $product['productID']; ?>" class="edit-btn">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button class="status-btn <?php echo $product['status'] === 'active' ? 'active' : 'inactive'; ?>">
                                                <?php echo ucfirst($product['status'] ?? 'active'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="orders-section">
                    <h2>Recent Orders</h2>
                    <?php if (empty($orders)): ?>
                        <p class="no-items">No orders yet.</p>
                    <?php else: ?>
                        <div class="orders-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td>#<?php echo $order['orderID']; ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                                            <td><?php echo $order['quantity']; ?></td>
                                            <td>€<?php echo number_format($order['quantity'] * $order['item_price'], 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="js/seller-dashboard.js"></script>
</body>
</html> 