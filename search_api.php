<?php
header('Content-Type: application/json');
require_once 'connection.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if (empty($q)) {
    echo json_encode(['status' => 'success', 'results' => []]);
    exit();
}

$search_term = "%" . $q . "%";
$results = [];

// 1. Search Mess
$stmt_mess = $conn->prepare("SELECT id, mess_name AS name, menu_name, menu_price AS price, description, service_type, menu_photos FROM mess WHERE mess_name LIKE ? OR menu_name LIKE ? OR description LIKE ?");
$stmt_mess->bind_param("sss", $search_term, $search_term, $search_term);
$stmt_mess->execute();
$res_mess = $stmt_mess->get_result();
while ($row = $res_mess->fetch_assoc()) {
    $photos = @unserialize($row['menu_photos']);
    $photo = (is_array($photos) && !empty($photos)) ? $photos[0] : 'assets/img/default-food.png';
    $results[] = [
        'id' => $row['id'],
        'type' => 'mess',
        'title' => $row['name'],
        'subtitle' => 'Menu: ' . $row['menu_name'],
        'price' => $row['price'],
        'description' => $row['description'],
        'service_type' => $row['service_type'],
        'image' => $photo,
        'url' => 'hoemess.php?id=' . $row['id']
    ];
}

// 2. Search Hotel
$stmt_hotel = $conn->prepare("SELECT id, hotel_name AS name, room_type, room_price AS price, amenities, service_type FROM hotel WHERE hotel_name LIKE ? OR room_type LIKE ? OR amenities LIKE ?");
$stmt_hotel->bind_param("sss", $search_term, $search_term, $search_term);
$stmt_hotel->execute();
$res_hotel = $stmt_hotel->get_result();
while ($row = $res_hotel->fetch_assoc()) {
    $results[] = [
        'id' => $row['id'],
        'type' => 'hotel',
        'title' => $row['name'],
        'subtitle' => 'Room: ' . $row['room_type'],
        'price' => $row['price'],
        'description' => $row['amenities'],
        'service_type' => $row['service_type'],
        'image' => 'assets/img/default-hotel.png',
        'url' => 'hotelm.php?id=' . $row['id']
    ];
}

// 3. Search Hostel
$stmt_hostel = $conn->prepare("SELECT id, hostel_name AS name, room_type, room_price AS price, amenities, service_type FROM hostel WHERE hostel_name LIKE ? OR room_type LIKE ? OR amenities LIKE ?");
$stmt_hostel->bind_param("sss", $search_term, $search_term, $search_term);
$stmt_hostel->execute();
$res_hostel = $stmt_hostel->get_result();
while ($row = $res_hostel->fetch_assoc()) {
    $results[] = [
        'id' => $row['id'],
        'type' => 'hostel',
        'title' => $row['name'],
        'subtitle' => 'Room: ' . $row['room_type'],
        'price' => $row['price'],
        'description' => $row['amenities'],
        'service_type' => $row['service_type'],
        'image' => 'assets/img/default-hostel.png',
        'url' => 'nashik.php?id=' . $row['id']
    ];
}

echo json_encode(['status' => 'success', 'query' => $q, 'results' => $results]);
exit();
?>
