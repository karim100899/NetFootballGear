<?php
session_start();
require_once 'config.php';

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    
    if (!$email) {
        $message = 'Please enter a valid email address.';
    } else {
        try {
            // Check if email already exists
            $checkStmt = $pdo->prepare("SELECT email FROM subscribers WHERE email = :email");
            $checkStmt->bindValue(':email', $email);
            $checkStmt->execute();
            
            if ($checkStmt->rowCount() > 0) {
                $message = 'You are already subscribed to our newsletter!';
                $success = true;
            } else {
                // Insert new subscriber
                $insertStmt = $pdo->prepare("INSERT INTO subscribers (email, subscribe_date) VALUES (:email, NOW())");
                $insertStmt->bindValue(':email', $email);
                $insertStmt->execute();
                
                $message = 'Thank you for subscribing to our newsletter!';
                $success = true;
            }
        } catch (PDOException $e) {
            $message = 'Sorry, we could not process your request at this time.';
            error_log("Newsletter subscription error: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Subscription - Football Merchandise</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .subscription-result {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            text-align: center;
            background-color: #f5f5f5;
            border-radius: 8px;
        }
        .success-message {
            color: #2e7d32;
        }
        .error-message {
            color: #c62828;
        }
    </style>
</head>
<body>
    <?php include 'views/header.php'; ?>
    
    <div class="subscription-result">
        <h1><?php echo $success ? 'Subscription Successful' : 'Subscription Status'; ?></h1>
        <p class="<?php echo $success ? 'success-message' : 'error-message'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
        <p><a href="index.php">Return to homepage</a></p>
    </div>
    
    <?php include 'views/footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html> 