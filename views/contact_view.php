<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="contact-container">
        <div class="contact-header">
            <h1>Contact Us</h1>
            <p>Have a question or feedback? We'd love to hear from you!</p>
        </div>

        <?php if (isset($success) && $success): ?>
            <div class="success-message" style="display: block;">
                Thank you for your message! We'll get back to you soon.
            </div>
        <?php endif; ?>

        <?php if (isset($error) && $error): ?>
            <div class="error-message" style="display: block;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="contact-form">
            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>

        <div class="contact-info">
            <div class="info-card">
                <i class="fas fa-envelope"></i>
                <h3>Email</h3>
                <p>100899@glr.nl</p>
                <p>100201@glr.nl</p>
            </div>
            <div class="info-card">
                <i class="fas fa-clock"></i>
                <h3>Response Time</h3>
                <p>Within 24 hours</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="js/main.js"></script>
</body>
</html> 