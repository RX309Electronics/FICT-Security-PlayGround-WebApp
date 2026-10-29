<?php
// Display errors. DONT leave this on in production.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// --- 1. RATE LIMITING (Bescherming tegen Brute-force) ---
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

$max_attempts = 3;  // Maximaal 3 foute pogingen
$lockout_time = 30; // 30 seconden slot op de deur

if ($_SESSION['login_attempts'] >= $max_attempts) {
    $time_passed = time() - $_SESSION['lockout_time'];
    if ($time_passed < $lockout_time) {
        $seconds_left = $lockout_time - $time_passed;
        die("<h3 style='color:red;'>Te veel mislukte inlogpogingen! Beveiliging geactiveerd. Probeer het over $seconds_left seconden opnieuw.</h3><br><a href='login.html'>Terug naar login</a>");
    } else {
        // Tijd is voorbij, reset de teller
        $_SESSION['login_attempts'] = 0;
    }
}

// Gegevens van je Databaseserver in het Netlab
$host = "10.61.0.171";
$db_user = "root";
$db_pass = "Admin2026!";
$db_name = "userdata";

// Maak verbinding met MySQL
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Verbinding mislukkt: " . $conn->connect_error);
}

// Vang de invoer op uit het formulier
$user = $_POST['username'];
$pass = $_POST['password'];

// --- 2. PREPARED STATEMENT (Bescherming tegen SQL Injection) ---
// We gebruiken placeholders (?) in plaats van de variabelen direct in de string te plakken.
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user, $pass); // "ss" staat voor twee strings
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Succes! Reset foute pogingen en stuur door
    $_SESSION['login_attempts'] = 0;
    $_SESSION['loggedin'] = true;
    header("Location: index.php"); // Let op: zorg dat je dashboard index.php heet i.v.m. sessiecontrole!
    exit();
} else {
    // Mislukt: verhoog de teller voor rate limiting
    $_SESSION['login_attempts']++;
    $_SESSION['lockout_time'] = time();

    $pogingen_over = $max_attempts - $_SESSION['login_attempts'];
    echo "<h1>Foutieve inloggegevens of gebruiker bestaat niet.</h1>";
    echo "<p style='color:red;'>Nog $pogingen_over poging(en) over voor je tijdelijk wordt geblokkeerd.</p>";
    echo "<a href='login.html'>Probeer opnieuw</a>";
}

$stmt->close();
$conn->close();
?>
