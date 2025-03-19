<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Football Merchandise</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h1><?php echo htmlspecialchars($pageTitle); ?></h1>
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <?php if ($switching): ?>
                <div class="info-message">Je wisselt van account. Je kunt altijd terug naar je vorige account.</div>
            <?php endif; ?>

            <?php if (isset($_GET['registered'])): ?>
                <div class="success-message">Registration successful! You can now log in.</div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="identifier">Email or Username</label>
                    <input type="text" id="identifier" name="identifier" required 
                           placeholder="Enter your email or username">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="auth-button">Log In</button>
            </form>
            
            <p class="auth-links">
                Don't have an account? <a href="register.php">Register here</a><br>
                <a href="index.php" class="back-link">Back to shop</a>
            </p>
        </div>
    </div>
</body>
</html> 