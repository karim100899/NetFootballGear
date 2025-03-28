<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="auth-page">
        <div class="auth-container">
            <h1>Forgot Password</h1>
            <p class="auth-description">Enter your email address and we'll send you a link to reset your password.</p>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?php echo htmlspecialchars($success); ?>
                    <p class="success-info">Please check your email for further instructions.</p>
                    <a href="login.php" class="back-to-login">Return to Login</a>
                </div>
            <?php else: ?>
                <form action="forgot-password.php" method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="submit-button">Send Reset Link</button>
                        <a href="login.php" class="back-link">Back to Login</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>

<style>
.auth-description {
    text-align: center;
    color: #666;
    margin-bottom: 2rem;
}

.success-message {
    text-align: center;
    padding: 2rem;
    background: #f8f8f8;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.success-message i {
    font-size: 3rem;
    color: #7abb7e;
    margin-bottom: 1rem;
}

.success-info {
    color: #666;
    margin: 1rem 0;
}

.back-to-login {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #7abb7e;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    margin-top: 1rem;
    transition: background-color 0.2s;
}

.back-to-login:hover {
    background: #619864;
}

.back-link {
    color: #666;
    text-decoration: none;
    text-align: center;
    margin-top: 1rem;
    display: block;
    transition: color 0.2s;
}

.back-link:hover {
    color: #7abb7e;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.submit-button {
    background: #7abb7e;
    color: white;
    border: none;
    padding: 0.8rem;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.2s;
}

.submit-button:hover {
    background: #619864;
}
</style> 