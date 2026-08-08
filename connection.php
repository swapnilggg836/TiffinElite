<?php
$host     = getenv('DB_HOST') ?: "localhost";
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "";
$db       = getenv('DB_NAME') ?: "yum";

$conn = new mysqli($host, $username, $password, $db);

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>