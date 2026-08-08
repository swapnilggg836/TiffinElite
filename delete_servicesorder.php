<?php
session_start();
header('Content-Type: application/json');

require_once 'connection.php';

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed."]));
}

$data = json_decode(file_get_contents("php://input"), true);
$order_id = $data['id'] ?? null;

if ($order_id) {
    $stmt = $conn->prepare("DELETE FROM servicesss WHERE id = ?");
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting order."]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid order ID."]);
}

$conn->close();
?>
