<?php
// add_to_cart.php
header('Content-Type: application/json');
require_once 'db_connection.php'; // Include your database connection file

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

$hotel_id = $data['hotel_id'];
$user_id = $data['user_id'];
$added_at = $data['added_at'];

// Insert the data into the database
$query = "INSERT INTO carthotel (hotel_id, user_id, added_at) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iis", $hotel_id, $user_id, $added_at);

if ($stmt->execute()) {
    echo json_encode(["message" => "Item added to cart successfully."]);
} else {
    echo json_encode(["message" => "Error adding item to cart."]);
}

$stmt->close();
$conn->close();
?>
