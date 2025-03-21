<?php
// cookies.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'functions/auth.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookiebeleid - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Zorg ervoor dat het pad naar je CSS-bestand correct is -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'views/header.php'; ?>

    <div class="container">
        <h1>Cookiebeleid</h1>
        <p>Laat ons u informeren over ons gebruik van cookies op de NetFootballGear-website.</p>

        <h2>Wat zijn cookies?</h2>
        <p>Cookies zijn kleine tekstbestanden die op uw computer of mobiele apparaat worden opgeslagen wanneer u een website bezoekt. Ze helpen de website om uw acties en voorkeuren (zoals inloggegevens, taal, lettergrootte en andere weergavevoorkeuren) gedurende een bepaalde tijd te onthouden.</p>

        <h2>Welke cookies gebruiken wij?</h2>
        <ul>
            <li><strong>Noodzakelijke cookies:</strong> Essentieel voor de werking van onze website.</li>
            <li><strong>Functionele cookies:</strong> Onthouden uw keuzes en bieden verbeterde functies.</li>
            <li><strong>Analytische cookies:</strong> Helpen ons te begrijpen hoe bezoekers onze website gebruiken.</li>
            <li><strong>Advertentiecookies:</strong> Maken advertenties relevanter voor u.</li>
        </ul>

        <h2>Hoe kunt u cookies beheren?</h2>
        <p>U kunt cookies beheren via uw browserinstellingen. De meeste webbrowsers bieden de mogelijkheid om cookies te blokkeren of te verwijderen. Raadpleeg de helpsectie van uw browser voor meer informatie.</p>

        <h2>Wijzigingen in ons cookiebeleid</h2>
        <p>We kunnen dit cookiebeleid van tijd tot tijd bijwerken. We raden u aan om deze pagina regelmatig te controleren op eventuele wijzigingen.</p>

        <h2>Contact</h2>
        <p>Als u vragen heeft over ons cookiebeleid, kunt u contact met ons opnemen via:</p>
        <p>Email: <a href="mailto:100899@glr.nl">100899@glr.nl</a></p>
    </div>

    <?php include 'views/footer.php'; ?>
</body>
</html>