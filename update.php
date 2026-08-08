<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle price update request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $new_price = $_POST['new_price'];

    $stmt = $conn->prepare("UPDATE mess SET menu_price = ? WHERE id = ?");
    $stmt->bind_param("di", $new_price, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
    $conn->close();
    exit;
}
?>
