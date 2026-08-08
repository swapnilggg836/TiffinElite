<?php
session_start();
header('Content-Type: application/json');

require_once 'connection.php';

if ($conn->connect_error) {
    die(json_encode(["message" => "Database connection failed: " . $conn->connect_error]));
}

// Read JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

$service_name = $data['service'] ?? '';
$user_id = $data['user_id'] ?? 1;
$user_name = $data['user_name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$address = $data['address'] ?? '';

if (!empty($service_name) && !empty($user_name) && !empty($email) && !empty($phone) && !empty($address)) {
    $stmt = $conn->prepare("INSERT INTO servicesss (service_name, user_id, user_name, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $service_name, $user_id, $user_name, $email, $phone, $address);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Service ordered successfully!"]);
    } else {
        echo json_encode(["message" => "Error ordering service: " . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(["message" => "Please fill all required fields."]);
}

$conn->close();
?>
