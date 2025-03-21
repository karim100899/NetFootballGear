<?php
// careers.php
require_once 'functions/auth.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrières - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Zorg ervoor dat het pad naar je CSS-bestand correct is -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'views/header.php'; ?>

<div class="container">
    <h1>Carrières bij NetFootballGear</h1>
    <p>Bij NetFootballGear zijn we altijd op zoek naar getalenteerde en gepassioneerde mensen om ons team te versterken. Hier zijn enkele van onze huidige teamleden:</p>

    <div class="team-member">
        <h2>Karim Lahraoui</h2>
        <div class="member-card">
            <img src="images/karim.jpg" alt="Karim Lahraoui" class="member-image">
            <p>Karim is een gepassioneerde ontwikkelaar met een liefde voor voetbal en technologie.</p>
            <a href="https://100899.stu.sd-lab.nl/portfolio" target="_blank" class="portfolio-link">Bekijk mijn portfolio</a>
        </div>
    </div>

    <div class="team-member">
        <h2>Ithai Pauw</h2>
        <div class="member-card">
            <img src="images/ithai.jpg" alt="Ithai Pauw" class="member-image">
            <p>Ithai is een creatieve ontwerper die altijd op zoek is naar innovatieve oplossingen.</p>
            <a href="https://100201.stu.sd-lab.nl/portfolio" target="_blank" class="portfolio-link">Bekijk mijn portfolio</a>
        </div>
    </div>
</div>

<?php include 'views/footer.php'; ?>
</body>
</html>
