<?php
$host = "localhost";
$server = "localhost";
$username = "root";
$password = "";
$db = "yum";

$conn = new mysqli($server, $username, $password, $db);

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>