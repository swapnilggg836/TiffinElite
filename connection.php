<?php
$host     = getenv('DB_HOST') ?: "localhost";
$port     = getenv('DB_PORT') ?: 3306;
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "";
$db       = getenv('DB_NAME') ?: "yum";

// Initialize mysqli
$conn = mysqli_init();
if (getenv('DB_HOST')) {
    // Enable SSL for cloud MySQL providers like Aiven
    mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
    @$conn->real_connect($host, $username, $password, $db, (int)$port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
} else {
    @$conn->real_connect($host, $username, $password, $db, (int)$port);
}

if ($conn->connect_error) {
    error_log("Database connection error: " . $conn->connect_error);
}

try {
    $pdo_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    if (getenv('DB_HOST')) {
        $pdo_options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
    }
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $username, $password, $pdo_options);
} catch (PDOException $e) {
    error_log("PDO Connection failed: " . $e->getMessage());
}
?>