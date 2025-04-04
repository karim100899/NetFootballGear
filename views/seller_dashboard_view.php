<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard - NetFootballGear</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/seller-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="container mt-4">
        <div class="text-center mb-4">
            <h1>Welcome, <?php echo htmlspecialchars($company['companyName']); ?>!</h1>
            <p>Manage your products and view your sales performance</p>
        </div>

        <?php if (isset($_GET['status'])): ?>
            <div class="alert alert-<?php echo $_GET['status'] === 'success' ? 'success' : 'danger'; ?>">
                <?php echo $_GET['status'] === 'success' ? 'Status updated successfully!' : 'There was an error updating the status.'; ?>
            </div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                        <h3>Total Sales</h3>
                        <p><?php echo $totalSales; ?> items</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-euro-sign fa-2x"></i>
                        <h3>Total Revenue</h3>
                        <p>€<?php echo number_format($totalRevenue, 2); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-box fa-2x"></i>
                        <h3>Active Products</h3>
                        <p><?php echo $activeProducts; ?> / <?php echo $totalProducts; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <section class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Your Products</h2>
                <a href="business-inquiry.php" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>
            <div class="row">
                <?php if (empty($products)): ?>
                    <p class="col text-center">No products yet. Add your first product!</p>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                                    <p class="card-text price">€<?php echo number_format($product['price'], 2); ?></p>
                                    <p class="sales">Sales: <?php echo $product['total_sales'] ?? 0; ?></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="edit-product.php?id=<?php echo $product['productID']; ?>" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="update-product-status.php" method="POST" class="status-form">
                                            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                            <input type="hidden" name="status" value="<?php echo $product['status'] === 'active' ? 'inactive' : 'active'; ?>">
                                            <button type="submit" class="btn btn-secondary">
                                                <?php echo ucfirst($product['status'] ?? 'active'); ?>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <section>
            <h2>Recent Orders</h2>
            <?php if (empty($orders)): ?>
                <p class="text-center">No orders yet.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table">
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
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 