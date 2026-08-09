<?php
session_start();
include 'connection.php'; 

if (!$conn) {
    die(json_encode(["message" => "Database connection failed: " . mysqli_connect_error()]));
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    die(json_encode(["message" => "No data received."]));
}

$messName = $data['messName'] ?? '';
$userId = $_SESSION['id'] ?? 1;
$name = $data['name'] ?? '';
$address = $data['address'] ?? '';
$paymentMethod = $data['paymentMethod'] ?? '';
$location = $data['location'] ?? '';

if (!$messName || !$name || !$address || !$paymentMethod || !$location) {
    die(json_encode(["message" => "All fields are required."]));
}

// Get mess_id from mess_name
$sql = "SELECT id FROM mess WHERE mess_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $messName);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die(json_encode(["message" => "Mess not found."]));
}

$messId = $row['id'];

// Insert into orders table
$sql = "INSERT INTO orders (mess_id, user_id, name, address, payment_method, location) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die(json_encode(["message" => "SQL Prepare Error: " . $conn->error]));
}

$stmt->bind_param("iissss", $messId, $userId, $name, $address, $paymentMethod, $location);

if ($stmt->execute()) {
    echo json_encode(["message" => "Order placed successfully!"]);
} else {
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();

?>
