<?php
// Database connection
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mess_name = $conn->real_escape_string($_POST['mess_name']);
    $menu_name = $conn->real_escape_string($_POST['menu_name']);
    $menu_price = $conn->real_escape_string($_POST['menu_price']);
    $description = $conn->real_escape_string($_POST['description']);

    // Handle file uploads
    $uploaded_files = [];
    if (!empty($_FILES['menu_photos']['name'][0])) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['menu_photos']['name'] as $key => $file_name) {
            $file_tmp = $_FILES['menu_photos']['tmp_name'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = uniqid() . '.' . $file_ext;
            $file_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $uploaded_files[] = $file_path;
            }
        }
    }

    // Convert uploaded file paths to a JSON string
    $menu_photos = json_encode($uploaded_files);

    // Insert data into the database
    $sql = "INSERT INTO hotelmenus (mess_name, menu_name, menu_photos, menu_price, description) 
            VALUES ('$mess_name', '$menu_name', '$menu_photos', '$menu_price', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "New menu added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
