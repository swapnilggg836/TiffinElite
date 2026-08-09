<?php
header('Content-Type: application/json');
require_once 'connection.php';

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

$sql = "SELECT id, hostel_name AS mess_name, room_type AS menu_name, room_price AS menu_price, amenities AS description, service_type FROM hostel";
$result = $conn->query($sql);

if (!$result) {
    $sql = "SELECT id, mess_name, menu_name, menu_photos, menu_price, address FROM hostel_info";
    $result = $conn->query($sql);
}

$hostelData = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rawPhotos = $row['menu_photos'] ?? null;
        $photos = [];
        if (!empty($rawPhotos)) {
            $decoded = json_decode($rawPhotos, true);
            $photos = is_array($decoded) ? $decoded : [$rawPhotos];
        }
        if (empty($photos)) {
            $photos = ['assets/img/default-hostel.png'];
        }
        $row['menu_photos'] = $photos;
        $hostelData[] = $row;
    }
}

echo json_encode($hostelData);
$conn->close();
?>
