<?php
// about.php
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
    <title>Over Ons - NetFootballGear</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Zorg ervoor dat het pad naar je CSS-bestand correct is -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'views/header.php'; ?>

<div class="container">
    <h1>Over Ons</h1>
    <p>Welkom bij NetFootballGear, uw nummer één bestemming voor alles wat met voetbal te maken heeft. Wij zijn gepassioneerd door de sport en streven ernaar om de beste producten en diensten aan te bieden aan onze klanten.</p>

    <h2>Onze Missie</h2>
    <p>Onze missie is om voetbalfans en spelers van alle niveaus te voorzien van hoogwaardige uitrusting en accessoires. We geloven dat iedereen de kans moet krijgen om zijn of haar passie voor voetbal te beleven.</p>

    <h2>Onze Geschiedenis</h2>
    <p>NetFootballGear is opgericht in 2025 door een groep voetballiefhebbers die hun liefde voor de sport wilden delen. Sindsdien zijn we gegroeid en hebben we een breed scala aan producten toegevoegd, van schoenen tot kleding en accessoires.</p>

    <h2>Waarom Kiezen Voor Ons?</h2>
    <ul>
        <li>Hoogwaardige producten</li>
        <li>Uitstekende klantenservice</li>
        <li>Snelle verzending</li>
        <li>Tevreden klanten</li>
    </ul>

    <h2>Neem Contact Met Ons Op</h2>
    <p>Als u vragen heeft of meer informatie wilt, neem dan gerust contact met ons op via onze <a href="contact.php">contactpagina</a>.</p>
</div>

<?php include 'views/footer.php'; ?>
</body>
</html>
