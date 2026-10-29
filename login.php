<?php

// Display errors. DONT leave this on in production.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Gegevens van je Databaseserver in het Netlab
$host = "10.61.0.171"; 
$db_user = "root";
$db_pass = "Admin2026!";
$db_name = "userdata";

// Maak verbinding met MySQL
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Vang de invoer op uit het formulier
$user = $_POST['username'];
$pass = $_POST['password'];

// ONVEILIG: De variabelen worden direct in de SQL-string geplakt (SQL Injection vatbaar!)
$sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Succes! Stuur de gebruiker door naar de homepage/dashboard
    header("Location: index.html");
    exit();
} else {
    echo "<h1>Foutieve inloggegevens of gebruiker bestaat niet.</h1>";
    echo "<a href='login.html'>Probeer opnieuw</a>";
}

$conn->close();
?>