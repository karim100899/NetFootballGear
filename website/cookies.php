<?php
// cookies.php
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
    <title>Cookie Policy - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ensure the path to your CSS file is correct -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'views/header.php'; ?>

<div class="container">
    <h1>Cookie Policy</h1>
    <p>Let us inform you about our use of cookies on the NetFootballGear website.</p>

    <h2>What are cookies?</h2>
    <p>Cookies are small text files that are stored on your computer or mobile device when you visit a website. They help the website remember your actions and preferences (such as login details, language, font size, and other display preferences) over a period of time.</p>

    <h2>What cookies do we use?</h2>
    <ul>
        <li><strong>Essential cookies:</strong> Necessary for the operation of our website.</li>
        <li><strong>Functional cookies:</strong> Remember your choices and provide enhanced features.</li>
        <li><strong>Analytical cookies:</strong> Help us understand how visitors use our website.</li>
        <li><strong>Advertising cookies:</strong> Make advertisements more relevant to you.</li>
    </ul>

    <h2>How can you manage cookies?</h2>
    <p>You can manage cookies through your browser settings. Most web browsers offer the ability to block or delete cookies. Please refer to your browser's help section for more information.</p>

    <h2>Changes to our cookie policy</h2>
    <p>We may update this cookie policy from time to time. We recommend that you check this page regularly for any changes.</p>

    <h2>Contact</h2>
    <p>If you have any questions about our cookie policy, you can contact us at:</p>
    <p>Email: <a href="mailto:100899@glr.nl">100899@glr.nl</a></p>
</div>

<?php include 'views/footer.php'; ?>
</body>
</html>