<?php
require_once 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST["service_id"];
    $service_name = $_POST["service_name"];
    $service_type = $_POST["service_type"];
    $user_name = $_POST["user_name"];
    $user_address = $_POST["user_address"];

    $sql = "INSERT INTO service_requestss (service_id, service_name, service_type, user_name, user_address) 
            VALUES ('$service_id', '$service_name', '$service_type', '$user_name', '$user_address')";

    if ($conn->query($sql) === TRUE) {
        echo "Service request submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
