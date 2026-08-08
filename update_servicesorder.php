<?php
session_start();
header('Content-Type: application/json');

require_once 'connection.php';
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

// Get JSON data from request
$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['id'] ?? null;
$status = $data['status'] ?? '';

if ($order_id && $status) {
    // Check if the 'status' column exists
    $checkColumn = $conn->query("SHOW COLUMNS FROM servicesss LIKE 'status'");
    if ($checkColumn->num_rows === 0) {
        die(json_encode(["success" => false, "message" => "Status column missing in database."]));
    }

    // Update order status
    $stmt = $conn->prepare("UPDATE servicesss SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating order."]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid data."]);
}

$conn->close();
?>
