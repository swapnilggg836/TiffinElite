<?php
header('Content-Type: application/json');
require_once 'connection.php';

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

$sql = "SELECT id, mess_name, menu_name, menu_photos, menu_price, description, service_type FROM mess";
$result = $conn->query($sql);

$messData = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rawPhotos = $row['menu_photos'];
        $photos = [];

        if (!empty($rawPhotos)) {
            $unserialized = @unserialize($rawPhotos);
            if (is_array($unserialized)) {
                $photos = $unserialized;
            } else {
                $decoded = json_decode($rawPhotos, true);
                if (is_array($decoded)) {
                    $photos = $decoded;
                } elseif (is_string($rawPhotos)) {
                    $photos = [$rawPhotos];
                }
            }
        }

        if (empty($photos)) {
            $photos = ['assets/img/default-food.png'];
        }

        $row['menu_photos'] = $photos;
        $messData[] = $row;
    }
}

echo json_encode($messData);
$conn->close();
?>

