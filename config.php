<?php
// Database configuratie
$host = 'localhost';
$dbname = 'BEROEPS2_100899';
$username = 'db100899beroeps';
$password = 't2dM8xH9@';

// Maak de databaseverbinding
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Fouten beter afhandelen
} catch (PDOException $e) {
    die("Kan geen verbinding maken met de database: " . $e->getMessage());
}