<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the hostel_info table
$sql = "SELECT id, mess_name, menu_name, menu_photos, menu_price, address FROM hostel_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $messData = [];
    while ($row = $result->fetch_assoc()) {
        // Ensure that menu_photos is a valid JSON array or null
        $row['menu_photos'] = json_decode($row['menu_photos'], true) ?? [];
        $messData[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($messData);
} else {
    echo json_encode([]);
}

$conn->close();
?>
