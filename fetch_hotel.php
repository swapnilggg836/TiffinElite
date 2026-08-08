<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the hotelmenus table
$sql = "SELECT  mess_name,menu_name, menu_photos, menu_price, description FROM hotelmenus";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $messData = [];
    while ($row = $result->fetch_assoc()) {
        $row['menu_photos'] = json_decode($row['menu_photos'], true);
        $messData[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($messData);
} else {
    echo json_encode([]);
}

$conn->close();
?>
