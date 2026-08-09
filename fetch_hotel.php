<?php
header('Content-Type: application/json');
require_once 'connection.php';

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

$sql = "SELECT id, hotel_name AS mess_name, room_type AS menu_name, room_price AS menu_price, amenities AS description, service_type FROM hotel";
$result = $conn->query($sql);

if (!$result) {
    $sql = "SELECT id, mess_name, menu_name, menu_photos, menu_price, description FROM hotelmenus";
    $result = $conn->query($sql);
}

$hotelData = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rawPhotos = $row['menu_photos'] ?? null;
        $photos = [];
        if (!empty($rawPhotos)) {
            $decoded = json_decode($rawPhotos, true);
            $photos = is_array($decoded) ? $decoded : [$rawPhotos];
        }
        if (empty($photos)) {
            $photos = ['assets/img/default-hotel.png'];
        }
        $row['menu_photos'] = $photos;
        $hotelData[] = $row;
    }
}

echo json_encode($hotelData);
$conn->close();
?>
