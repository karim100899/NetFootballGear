<?php
// careers.php
require_once 'functions/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careers - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ensure the path to your CSS file is correct -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'views/header.php'; ?>

<div class="container">
    <h1>Careers at NetFootballGear</h1>
    <p>At NetFootballGear, we are always looking for talented and passionate individuals to join our team. Here are some of our current team members:</p>

    <div class="team-member">
        <h2>Karim Lahraoui</h2>
        <div class="member-card">
            <img src="images/karim.jpg" alt="Karim Lahraoui" class="member-image">
            <p>Passionate software developer focused on building creative web solutions. Skilled in full-stack development and modern web technologies. Currently studying software development while working on projects to improve my skills.</p>
            <a href="https://100899.stu.sd-lab.nl/portfolio" target="_blank" class="portfolio-link">View my portfolio</a>
        </div>
    </div>

    <div class="team-member">
        <h2>Ithai Pauw</h2>
        <div class="member-card">
            <img src="images/ithai.jpg" alt="Ithai Pauw" class="member-image">
            <p>I am a student software developer at the Grafisch Lyceum Rotterdam and a motivated front-end developer. Check out my projects and Skills.</p>
            <a href="https://100201.stu.sd-lab.nl/portfolio" target="_blank" class="portfolio-link">View my portfolio</a>
        </div>
    </div>
</div>

<?php include 'views/footer.php'; ?>
</body>
</html>
