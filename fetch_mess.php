<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT mess_name, menu_name, menu_photos, menu_price, description, service_type FROM mess";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $messData = [];
    while ($row = $result->fetch_assoc()) {
        $row['menu_photos'] = unserialize($row['menu_photos']);
        $messData[] = $row;
    }
    echo json_encode($messData);
} else {
    echo json_encode([]);
}

$conn->close();
?>

