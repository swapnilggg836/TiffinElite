<?php
include 'connection.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['menu_name'], $data['price'], $data['name'], $data['address'], $data['paymentMethod'], $data['location'])) {
    echo json_encode(["message" => "Error: Missing required fields."]);
    exit;
}

$menuName = $data['menu_name'];
$price = $data['price'];
$name = $data['name'];
$address = $data['address'];
$paymentMethod = $data['paymentMethod'];
$location = $data['location'];

$sql = "INSERT INTO ordershostel (menu_name, price, user_name, address, payment_method, location) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdssss", $menuName, $price, $name, $address, $paymentMethod, $location);

if ($stmt->execute()) {
    echo json_encode(["message" => "Order placed successfully!"]);
} else {
    echo json_encode(["message" => "Error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
