<?php
// db.php
$host = 'localhost';  // Change if using a different host
$dbname = 'uba_ticketing';  // Your database name
$user = 'root';       // Your database username
$pass = '';           // Your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
