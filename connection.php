<?php
$host     = getenv('DB_HOST') ?: "localhost";
$port     = getenv('DB_PORT') ?: 3306;
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "";
$db       = getenv('DB_NAME') ?: "yum";

$conn = new mysqli($host, $username, $password, $db, (int)$port);

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>