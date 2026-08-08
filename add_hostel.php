<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mess_name = $_POST['mess_name'];
    $menu_name = $_POST['menu_name'];
    $menu_price = $_POST['menu_price'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];
    $service_type = $_POST['service_type'];

    // Handle file uploads
    $uploaded_files = [];
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    foreach ($_FILES['menu_photos']['tmp_name'] as $key => $tmp_name) {
        $file_name = basename($_FILES['menu_photos']['name'][$key]);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($tmp_name, $file_path)) {
            $uploaded_files[] = $file_path;
        }
    }

    // Convert uploaded file paths to JSON for storage
    $menu_photos = json_encode($uploaded_files);

    // Insert data into the database
    $sql = "INSERT INTO hostel_info (mess_name, menu_name, menu_photos, menu_price, address, description, opening_time, closing_time, service_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsdsss", $mess_name, $menu_name, $menu_photos, $menu_price, $address, $description, $opening_time, $closing_time, $service_type);

    if ($stmt->execute()) {
        echo "Mess information added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
