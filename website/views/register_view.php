<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Football Merchandise</title>
    <link rel="icon" href="images/NetFootballGear-flaticon.png" type="image/png">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h1>Register</h1>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="phonenumber">Phone Number (optional)</label>
                    <input type="tel" id="phonenumber" name="phonenumber">
                </div>
                
                <button type="submit" class="auth-button">Register</button>
            </form>
            
            <p class="auth-links">
                Already have an account? <a href="login.php">Log in here</a><br>
                <a href="index.php" class="back-link">Back to shop</a>
            </p>
        </div>
    </div>
</body>
</html> 