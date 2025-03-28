<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="auth-page">
        <div class="auth-container">
            <h1>Reset Password</h1>
            
            <?php if ($error): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <?php echo htmlspecialchars($success); ?>
                    <a href="login.php" class="back-to-login">Go to Login</a>
                </div>
            <?php elseif ($validToken): ?>
                <form action="reset-password.php?token=<?php echo htmlspecialchars($token); ?>" method="POST" class="auth-form">
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div class="password-input">
                            <input type="password" id="password" name="password" required minlength="8">
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small class="password-hint">Password must be at least 8 characters long</small>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <div class="password-input">
                            <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
                            <button type="button" class="toggle-password" onclick="togglePassword('confirm_password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="submit-button">Reset Password</button>
                </form>
            <?php else: ?>
                <div class="error-container">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>This password reset link has expired or is invalid.</p>
                    <a href="forgot-password.php" class="request-new-link">Request New Reset Link</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const button = input.nextElementSibling;
        const icon = button.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>

    <style>
    .password-input {
        position: relative;
        display: flex;
        align-items: center;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        padding: 0;
        font-size: 1.1rem;
    }

    .toggle-password:hover {
        color: #7abb7e;
    }

    .password-hint {
        display: block;
        color: #666;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .error-container {
        text-align: center;
        padding: 2rem;
    }

    .error-container i {
        font-size: 3rem;
        color: #ff6b6b;
        margin-bottom: 1rem;
    }

    .request-new-link {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #7abb7e;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 1rem;
        transition: background-color 0.2s;
    }

    .request-new-link:hover {
        background: #619864;
    }

    .success-message {
        text-align: center;
        padding: 2rem;
        background: #f8f8f8;
        border-radius: 8px;
    }

    .success-message i {
        font-size: 3rem;
        color: #7abb7e;
        margin-bottom: 1rem;
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
    </style>
</body>
</html> 