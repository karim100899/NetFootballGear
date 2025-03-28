<?php
// about.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'functions/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ensure the path to your CSS file is correct -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'views/header.php'; ?>

<div class="container">
    <h1>About Us</h1>
    <p>Welcome to NetFootballGear, your number one destination for everything related to football. We are passionate about the sport and strive to offer the best products and services to our customers.</p>

    <h2>Our Mission</h2>
    <p>Our mission is to provide football fans and players of all levels with high-quality equipment and accessories. We believe that everyone should have the chance to experience their passion for football.</p>

    <h2>Our History</h2>
    <p>NetFootballGear was founded in 2025 by a group of football enthusiasts who wanted to share their love for the sport. Since then, we have grown and added a wide range of products, from shoes to clothing and accessories.</p>

    <h2>Why Choose Us?</h2>
    <ul>
        <li>High-quality products</li>
        <li>Excellent customer service</li>
        <li>Fast shipping</li>
        <li>Satisfied customers</li>
    </ul>

    <h2>Contact Us</h2>
    <p>If you have any questions or would like more information, please feel free to contact us via our <a href="contact.php">contact page</a>.</p>
</div>

<?php include 'views/footer.php'; ?>
</body>
</html>
