<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messName = $_POST['mess_name'];
    $menuName = $_POST['menu_name'];
    $menuPrice = $_POST['menu_price'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $openingTime = $_POST['opening_time'];
    $closingTime = $_POST['closing_time'];
    $serviceType = $_POST['service_type'];

    // Ensure the uploads directory exists
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handling file uploads
    $menuPhotos = [];
    foreach ($_FILES['menu_photos']['tmp_name'] as $key => $tmp_name) {
        $fileName = basename($_FILES['menu_photos']['name'][$key]);
        $fileTmp = $_FILES['menu_photos']['tmp_name'][$key];
        $fileDestination = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $fileDestination)) {
            $menuPhotos[] = $fileDestination;
        } else {
            echo "Error uploading file: $fileName";
        }
    }

    $menuPhotosSerialized = serialize($menuPhotos);

    // Insert data into database
    $sql = "INSERT INTO mess (mess_name, menu_name, menu_photos, menu_price, address, description, opening_time, closing_time, service_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $messName, $menuName, $menuPhotosSerialized, $menuPrice, $address, $description, $openingTime, $closingTime, $serviceType);

    if ($stmt->execute()) {
        echo "Mess information added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
